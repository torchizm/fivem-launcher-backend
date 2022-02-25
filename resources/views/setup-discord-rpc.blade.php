@extends('layouts.app')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-lg-6 text-center">
        <h1 class="text-center font-weight-bold">{{ __('nav.setup-discord-rpc') }}</h1>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-6 text-center">
        <h4 class="text-center font-weight-bold">
            <a href="https://discord.com/developers">{{ __('nav.goto-discord-develoeprs') }}</a>
        </h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-6 text-center">
        <h4 class="text-center font-weight-bold">
            {{ __('nav.create-or-open-project') }}
        </h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/rpc.guide.applications.png')}}">
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-8 text-center">
        <h4 class="text-center font-weight-bold">{{ __('nav.copy-client-id') }}</h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/rpc.guide.clientid.png')}}">
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-8 text-center">
        <h4 class="text-center font-weight-bold">{{ __('nav.goto-rich-presence') }}</h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/rpc.guide.rich.presence.png')}}">
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-8 text-center">
        <h4 class="text-center font-weight-bold">{{ __('nav.add-photos-and-copy-name') }}</h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/rpc.guide.image.keys.png')}}">
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-8 text-center">
        <h4 class="text-center font-weight-bold">{{ __('nav.rpc-result') }}</h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/rpc.guide.result.png')}}">
    </div>
</div>
@endsection
