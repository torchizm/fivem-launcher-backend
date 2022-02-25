@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @if ($currentLauncher)
        <div class="col-12">
            <form method="POST" action="{{$currentLauncher->path() . '/edit'}}">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header"><p class="font-italic">{{$currentLauncher->token}}</p><br><p class="font-italic">{{$currentLauncher->owner()->email}}</p></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="launcherVersion" class="col-md-2 form-label text-md-right">{{ __('nav.launcherVersion')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="launcherVersion" id="launcherVersion" placeholder="Launcher Version" value="{{$currentLauncher->version}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isSuspended" class="col-md-2 form-label text-md-right">{{ __('nav.isSuspended')}}</label>
                            <div class="col-md-6">
                                <label class="switch">
                                @if ($currentLauncher->is_suspended)
										<input type="checkbox" name="isSuspended" value="True" checked>
									@else
										<input type="checkbox" name="isSuspended" value="True">
									@endif
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maintenance" class="col-md-2 form-label text-md-right">{{ __('nav.maintenance')}}</label>
                            <div class="col-md-6">
                                <label class="switch">
                                @if ($currentLauncher->maintenance)
										<input type="checkbox" name="maintenance" value="True" checked>
									@else
										<input type="checkbox" name="maintenance" value="True">
									@endif
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
							<div class="col-md-6 offset-md-2">
								<button type="submit" class="btn btn-grullo text-cultured">{{ __('nav.updateLauncher') }}</button>
							</div>
						</div>
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
