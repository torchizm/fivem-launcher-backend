@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-8">
            <div class="card">
                <div class="card-header">{{ __('nav.addServer')}}</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								{{ session('message') }}
						</div>
                    @endif
                    <form method="POST" action="{{ route('add-server') }}">
                         @csrf
                        <div class="form-group row">
                            <label for="serverName" class="col-md-2 form-label text-md-right">{{ __('nav.serverName')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="serverName" id="serverName" placeholder="{{ __('nav.serverName')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="launcherToken" class="col-md-2 form-label text-md-right">{{ __('nav.launcherToken')}}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="launcherToken" id="launcherToken" placeholder="{{ __('nav.token')}}">
                            </div>
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
