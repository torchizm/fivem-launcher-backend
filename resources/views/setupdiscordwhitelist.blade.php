@extends('layouts.app')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-lg-6 text-center">
        <h1 class="text-center font-weight-bold">{{ __('nav.setup-discord-whitelist') }}</h1>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-6 text-center">
        <h4 class="text-center font-weight-bold">
            <a href="https://lapi.vlastcommunity.net/bot">{{ __('nav.add-bot-to-discord') }}</a>
        </h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/discord.wl.add.png')}}">
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-8 text-center">
        <h4 class="text-center font-weight-bold">{{ __('nav.discord-wl-settings') }}</h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/discord.wl.settings.png')}}">
    </div>
</div>
@endsection
