@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-6">
            <div class="card">
            <div class="card-header">{{ __('nav.welcome') }}</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								{{ session('message') }}
						</div>
                    @endif

                    <form method="POST" action="{{'/dashboard/first/' . $user->id}}">
                         @csrf
                         @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-label text-md-right">{{ __('nav.name')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="User Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="oldPassword" class="col-md-4 form-label text-md-right">{{ __('nav.oldPassword')}}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 form-label text-md-right">{{ __('nav.newPassword')}}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('nav.confirmPassword') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
							<div class="col-md-6 offset-md-2">
								<button type="submit" class="btn btn-grullo text-cultured">{{ __('nav.startUsing') }}</button>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
