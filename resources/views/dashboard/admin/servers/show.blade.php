@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-4">
            <div class="card">
                <div class="card-header"><a href="/dashboard">/{{__('nav.dashboard')}}</a>/{{ __('nav.servers')}}</div>

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
        <div class="col-8">
            @if ($currentServer)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            @can('update', $currentServer)
                            <form action="{{$currentServer->adminPath() . '/edit'}} " class="ml-2 d-inline">
                                <button type="submit" class="btn btn-grullo">{{__('nav.editServer')}}</button>
                            </form>
                            <form method="POST" action="/dashboard/admin/server/{{$currentServer->slug}}/delete" class="ml-2 d-inline">
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
                        <h1>{{$currentServer->name}} </h1>
                        <hr>
                        <p>{{__('nav.serverIP')}}: {{$currentServer->server_ip}}</p>
                        <p>{{__('nav.serverPort')}}: {{$currentServer->server_port}}</p>
                        <p>{{__('nav.teamspeakIP')}}: {{$currentServer->teamspeak_ip}}</p>
                        <p>{{__('nav.teamspeakPort')}}: {{$currentServer->teamspeak_port}}</p>
                        <p>{{__('nav.teamspeakPassword')}}: {{$currentServer->teamspeak_password}}</p>
                        <p>{{__('nav.maximumPlayers')}}: {{$currentServer->max_players}}</p>
                        <p>Byte count: {{$currentServer->byte_count}}</p>
                    <p>{{__('nav.isLauncherRequired')}}: @if ($currentServer->is_launcher_req)
                        {{__('nav.yes')}}
                    @else
                        {{__('nav.no')}}
                    @endif</p>
                    <p>{{__('nav.maintenance')}}: @if ($currentServer->maintenance)
                        {{__('nav.yes')}}
                    @else
                        {{__('nav.no')}}
                    @endif</p>
                    <p>{{__('nav.auto_whitelist')}}: @if ($currentServer->auto_whitelist)
                        {{__('nav.yes')}}
                    @else
                        {{__('nav.no')}}
                    @endif</p>
                    <p>{{__('nav.discord_whitelist')}}: @if ($currentServer->discord_whitelist)
                        {{__('nav.yes')}}
                    @else
                        {{__('nav.no')}}
                    @endif</p>
                    <p>{{__('nav.theme')}}: {{$theme->name}}</p>
                    <p>{{__('nav.createdAt')}}: {{$currentServer->created_at->diffForHumans()}}</p>
                    <p>{{__('nav.updatedAt')}}: {{$currentServer->updated_at->diffForHumans()}}</p>
                    <p>Owner: {{$currentServer->owner()->name}}</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                <div class="row">
                    <h2 class="mt-2">{{__('nav.playerCount')}}: {{$currentServer->players()->count()}}</h2>
                </div>
                @if ($currentServer->players()->count() > 0)
                <div class="row">
                    @foreach ($currentServer->players() as $player)
                        <div class="card p-2 m-2" style="width: 18rem;">
                            <img class="card-img-top" src="{{$player->profile_photo}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$player->username}}</h5>
                                <p class="card-text">{{$player->uid}}</p>
                                <p>{{__('nav.whitelist')}}:
                                    @if ($player->whitelist)
                                        {{__('nav.yes')}}
                                    @else
                                        {{__('nav.no')}}
                                    @endif</p>
                                <p>{{ __('nav.isBanned')}}:
                                    @if ($player->is_banned)
                                        {{__('nav.yes')}}
                                    @else
                                        {{__('nav.no')}}
                                    @endif
                                </p>

                                @if ($player->bans()->count() > 0)
                                    <p class="card-text">{{__('nav.banCount')}}: {{$player->bans()->count()}}</p>
                                    <a href="{{ $player->banPath() }}" class="btn btn-grullo">{{__('nav.banHistory')}}</a>
                                @endif

                                @can('update', $currentServer)
                                    <form action="{{$player->banPath() . '/ban'}} " class="ml-2 d-inline">
                                        <button type="submit" class="btn btn-danger">{{__('nav.ban')}}</button>
                                    </form>
                                @endcan
                                @can('update', $currentServer)
                                    <form action="{{$player->deletePath() . '/delete'}} " class="ml-2 d-inline">
                                        <button type="submit" class="btn btn-danger">{{__('nav.delete')}}</button>
                                    </form>
                                @endcan
                                @can('update', $currentServer)
                                    <form action="{{$player->banPath() . '/edit'}} " class="ml-2 d-inline">
                                        <button type="submit" class="btn btn-info">{{__('nav.permPlayer')}}</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
