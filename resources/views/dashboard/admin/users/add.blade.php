@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-8">
            <div class="card">
                <div class="card-header">Add User</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								{{ session('message') }}
						</div>
                    @endif
                    <form method="POST" action="{{ route('add-user') }}">
                         @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-2 form-label text-md-right">Email:</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-2 form-label text-md-right">{{ __('nav.role')}}</label>
                            <select class="form-control col-4" name="role" id="role">
                            <option value="0">Basic User</option>
                            <option value="1">Developer</option>
                            <option value="2">Server Moderator</option>
                            <option value="3">Server Admin</option>
                            <option value="4">Admin</option>
                          </select>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
							<div class="col-md-6 offset-md-2">
								<button type="submit" class="btn btn-grullo text-cultured">{{ __('nav.add') }}</button>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
