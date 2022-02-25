@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-8">
            <div class="card">
                <div class="card-header">{{ __('nav.addLauncher')}}</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								{{ session('message') }}
						</div>
                    @endif
                    <form method="POST" action="{{ route('add-launcher') }}">
                         @csrf
                        <div class="form-group row">
                            <label for="version" class="col-md-2 form-label text-md-right">{{ __('nav.version')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="version" id="version" placeholder="Launcher Version">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user" class="col-md-2 form-label text-md-right">{{ __('nav.launcherOwner')}}</label>
                            <select class="form-control col-4" name="user" id="user">
                                @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->email}}</option>
                                @endforeach
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
