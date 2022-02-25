@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-4 my-3">
            <div class="card">
                <div class="card-header">{{ __('nav.launchers')}}</div>

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
        <div class="col-4 my-3">
            <div class="card">
                <div class="card-header">{{ __('nav.servers')}}</div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if ($servers)
                            @foreach ($servers as $server)
                                <li class="list-group-item"><a href="{{ $server->adminPath() }}" class="nav-link text-eviolet">{{$server->name}}</a></li>
                            @endforeach
                        @endif
                        <li class="list-group-item"><a href="{{ url('/dashboard/server/add') }}" class="nav-link text-eviolet"><i class="fas fa-plus text-eviolet"></i> {{ __('nav.addServer') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-4 my-3">
            <div class="card">
                <div class="card-header">{{ __('nav.users')}}</div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if ($users)
                            @foreach ($users as $user)
                                <li class="list-group-item"><a href="{{ $user->path() }}" class="nav-link text-eviolet">@if ($user->name)
                                    {{$user->name}}
                                @else
                                    {{$user->email}}
                                @endif</a></li>
                            @endforeach
                        @endif
                    <li class="list-group-item"><a href="{{ url('/dashboard/admin/user/add') }}" class="nav-link text-eviolet"><i class="fas fa-plus text-eviolet"></i> {{ __('nav.addUser') }}</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
