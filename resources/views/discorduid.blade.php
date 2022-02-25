@extends('layouts.app')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-lg-6 text-center">
        <h1 class="text-center font-weight-bold">{{ __('nav.discord-uid') }}</h1>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-6 text-center">
        <h4 class="text-center font-weight-bold">{{ __('nav.discord-developermode') }}</h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/discord-developermode.png')}}">
    </div>
</div>
<div class="row justify-content-center my-5">
    <div class="col-lg-8 text-center">
        <h4 class="text-center font-weight-bold">{{ __('nav.discord-getuid') }}</h4>
    </div>
</div>
<div class="row justify-content-center my-5">
    <div style="max-width: 750px;">
        <img class="d-block w-100 rgba-purple-slight" src="{{ url('img/get-uid.png')}}">
    </div>
</div>
@endsection
