@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-4">
            <div class="card">
                <div class="card-header"> <a href="/dashboard">/{{__('nav.dashboard')}}</a>/{{__('nav.launchers')}}</div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if ($launchers)
                            @foreach ($launchers as $launcher)
                                <li class="list-group-item"><a href="{{ $launcher->path() }}" class="nav-link text-eviolet">@if ($launcher->server())
                                    {{$launcher->server()->name}}
                                @else
                                    {{$launcher->owner()->email}}
                                @endif</a></li>
                            @endforeach
                        @endif
                    <li class="list-group-item"><a href="{{ url('/dashboard/admin/launcher/add') }}" class="nav-link text-eviolet"><i class="fas fa-plus text-eviolet"></i> {{ __('nav.addLauncher') }}</a></li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            @if ($currentLauncher)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                        @can('update', $currentLauncher)
                            <form action="{{$currentLauncher->path() . '/edit'}}" class="ml-2 d-inline">
                            <button type="submit" class="btn btn-grullo">{{__('nav.editLauncher')}}</button>
                        </form>
                        <form method="POST" action="/dashboard/admin/launcher/{{$currentLauncher->id}}/delete" class="ml-2 d-inline">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm text-cultured">{{__('nav.delete')}}</button>
                        </form>
                        @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('message'))
                        <div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								{{ session('message') }}
						</div>
                        @endif
                        <h1>@if ($currentLauncher->server())
                                    {{$currentLauncher->server()->name}}
                                @else
                                    {{$currentLauncher->token}}
                                @endif</h1>
                        <hr>
                        <p>{{__('nav.token')}}: {{$currentLauncher->token}}</p>
                        <p>{{__('nav.version')}}: {{$currentLauncher->version}}</p>
                        <p>{{__('nav.launcherOwner')}}: {{$currentLauncher->owner()->email}}</p>
                    <p>{{__('nav.isSuspended')}}: @if ($currentLauncher->is_suspended)
                        {{__('nav.yes')}}
                    @else
                        {{__('nav.no')}}
                    @endif</p>
                    <p>{{__('nav.maintenance')}}: @if ($currentLauncher->maintenance)
                        {{__('nav.yes')}}
                    @else
                        {{__('nav.no')}}
                    @endif</p>
                    <p>{{__('nav.createdAt')}}: {{$currentLauncher->created_at->diffForHumans()}}</p>
                        <p>{{__('nav.updatedAt')}}: {{$currentLauncher->updated_at->diffForHumans()}}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
