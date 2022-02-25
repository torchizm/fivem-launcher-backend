@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @if ($currentServer)
        <div class="col-4">
            @if ($currentServer->logo_path)
			    <img src="/storage/{{$currentServer->logo_path}}" class="img-circle-lg" alt="">
			@else
				<img src="{{ asset('img/vlast.png')}}" class="img-circle-lg border border-dark" alt="">
			@endif
			<form method="POST" action="{{$currentServer->path() . '/logo'}}" enctype="multipart/form-data">
			    @csrf
				<div class="form-group row">
					<label for="logo"></label>
					<input type="file" name="logo">
				</div>
				<div class="form-group row">
					<button type="submit" class="btn btn-grullo"><abbr title="{{__('nav.maxFileSize')}}">{{__('nav.changeLogo')}} <i class="fa fa-exclamation-circle"></i></abbr></button>
				</div>
            </form>
        </div>
        <div class="col-8">
            <form method="POST" action="{{$currentServer->path() . '/edit'}}">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header"><input type="text" class="form-control" name="serverName" id="serverName" placeholder="Server Name" value="{{$currentServer->name}}"></div>

                    <div class="card-body">
                        <div class="form-group row">
							<label for="serverDescription" class="col-md-4 col-form-label text-md-right">{{ __('nav.serverDescription') }}</label>
							<div class="col-md-6">
								<textarea id="serverDescription" type="text" class="form-control" name="serverDescription" maxlength="300">{{$currentServer->description}}</textarea>
							</div>
						</div>
                        <div class="form-group row">
                            <label for="serverIP" class="col-md-4 form-label text-md-right">{{ __('nav.serverIP')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="serverIP" id="serverIP" placeholder="Server IP" value="{{$currentServer->server_ip}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="serverPort" class="col-md-4 form-label text-md-right">{{ __('nav.serverPort')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="serverPort" id="serverPort" placeholder="Server Port" value="{{$currentServer->server_port}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="teamspeakIP" class="col-md-4 form-label text-md-right">{{ __('nav.teamspeakIP')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="teamspeakIP" id="teamspeakIP" placeholder="Teamspeak IP" value="{{$currentServer->teamspeak_ip}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="teamspeakPort" class="col-md-4 form-label text-md-right">{{ __('nav.teamspeakPort')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="teamspeakPort" id="teamspeakPort" placeholder="Teamspeak Port" value="{{$currentServer->teamspeak_port}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="teamspeakPassword" class="col-md-4 form-label text-md-right">{{ __('nav.teamspeakPassword')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="teamspeakPassword" id="teamspeakPassword" placeholder="Teamspeak Password" value="{{$currentServer->teamspeak_password}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maxPlayers" class="col-md-4 form-label text-md-right">Maksimum oyuncu sayisi</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="maxPlayers" id="maxPlayers" placeholder="Maksimum oyuncu sayisi" value="{{$currentServer->max_players}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rpcId" class="col-md-4 form-label text-md-right">RPC ID</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="rpcId" id="rpcId" placeholder="RPC ID" value="{{$currentServer->rpc_id}}">
                            </div>
                            <span>
                                <a href="{{ url('setup-discord-rpc')}}">{{ __('nav.discord_whitelist_help') }}</a>
                            </span>
                        </div>
                        <div class="form-group row">
                            <label for="rpcLargeImageKey" class="col-md-4 form-label text-md-right">RPC large image key</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="rpcLargeImageKey" id="rpcLargeImageKey" placeholder="RPC large image key" value="{{$currentServer->rpc_largeimage_key}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rpc_largeimage_text" class="col-md-4 form-label text-md-right">RPC large image text</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="rpc_largeimage_text" id="rpc_largeimage_text" placeholder="RPC small image text" value="{{$currentServer->rpc_largeimage_text}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rpc_smallimage_key" class="col-md-4 form-label text-md-right">RPC small image key</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="rpc_smallimage_key" id="rpc_smallimage_key" placeholder="RPC small image key" value="{{$currentServer->rpc_smallimage_key}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rpc_smallimage_text" class="col-md-4 form-label text-md-right">RPC small image text</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="rpc_smallimage_text" id="rpc_smallimage_text" placeholder="RPC small image text" value="{{$currentServer->rpc_smallimage_text}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="byte_count" class="col-md-4 form-label text-md-right">exe byte count</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="byte_count" id="byte_count" placeholder="exe byte count" value="{{$currentServer->byte_count}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="theme_index" class="col-md-4 form-label text-md-right">{{ __('nav.theme')}}</label>
                            <div class="col-md-6">
                                <select class="form-control col-md-12" name="theme_index" id="theme_index" value="{{$currentServer->theme_index}}">
                                @foreach($themes as $theme)
                                    @if($currentServer->theme_index == $theme->id)
                                        <option selected value="{{$theme->id}}">{{__($theme->name)}}</option>
                                    @else
                                        <option value="{{$theme->id}}">{{__($theme->name)}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isLauncherRequired" class="col-md-4 form-label text-md-right">{{ __('nav.isLauncherRequired')}}</label>
                            <div class="col-md-6">
                                <label class="switch">
                                @if ($currentServer->is_launcher_req)
										<input type="checkbox" name="isLauncherRequired" value="True" checked>
									@else
										<input type="checkbox" name="isLauncherRequired" value="True">
									@endif
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maintenance" class="col-md-4 form-label text-md-right">{{ __('nav.maintenance')}}</label>
                            <div class="col-md-6">
                                <label class="switch">
                                @if ($currentServer->maintenance)
										<input type="checkbox" name="maintenance" value="True" checked>
									@else
										<input type="checkbox" name="maintenance" value="True">
									@endif
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="auto_whitelist" class="col-md-4 form-label text-md-right">{{ __('nav.auto_whitelist')}}</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    @if ($currentServer->auto_whitelist)
										<input type="checkbox" name="auto_whitelist" value="True" checked>
									@else
										<input type="checkbox" name="auto_whitelist" value="True">
									@endif
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discord_whitelist" class="col-md-4 form-label text-md-right">{{ __('nav.discord_whitelist')}}</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    @if ($currentServer->discord_whitelist)
										<input type="checkbox" name="discord_whitelist" value="True" checked>
									@else
										<input type="checkbox" name="discord_whitelist" value="True">
									@endif
                                    <span class="slider round"></span>
                                </label>

                                <span>
                                    <a href="{{ url('setup-discord-whitelist')}}">{{ __('nav.discord_whitelist_help') }}</a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
							<div class="col-md-6 offset-md-2">
								<button type="submit" class="btn btn-grullo text-cultured">{{ __('nav.updateServer') }}</button>
							</div>
						</div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">{{__('nav.invalidServer')}}</div>

                    <div class="card-body">
                        {{__('nav.invalidServerDescription')}}
                    </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
