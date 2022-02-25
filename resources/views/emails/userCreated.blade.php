@component('mail::message')
# {{ __('nav.userCreatedTitle')}}

{{__('nav.userCreatedDescription')}}

<div>
    Password: {{$password}}
</div>

@component('mail::button', ['url' => $url])
{{__('nav.login')}}
@endcomponent

{{ config('app.name') }}
@endcomponent
