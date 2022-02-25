@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('nav.reason')}}</th>
            <th scope="col">{{__('nav.time')}}</th>
            <th scope="col">{{__('nav.activeTime')}}</th>
            <th scope="col">{{__('nav.bannedOn')}}</th>
            <th scope="col">{{__('nav.bannedFrom')}}</th>
            <th scope="col">{{__('nav.playerSettings')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bans as $ban)
                <tr>
                <th scope="row">{{$ban->uid}}</th>
                <td>{{$ban->reason}}</td>
                <td>{{$ban->until->diffInDays($ban->created_at)}} {{str_plural('day', $ban->until->diffInDays($ban->created_at))}}</td>
                @if (!now()->lessThan($ban->until))
                    <td>{{ __('nav.notActive')}}</td>
                @else
                    <td>{{$ban->until->diffForHumans(['parts' => 5, 'short' => true])}}</td>
                @endif
                <td>{{$ban->created_at->setTimezone(session('timezone'))->toDateTimeString()}} ({{$ban->created_at->diffForHumans()}})</td>
                <td>{{App\Server::where('slug', $ban->server_slug)->first()->name}}</td>
                @can('update', App\Server::where('slug', $ban->server_slug)->first())
                    <td>
                        <form method="POST" action="{{url("/dashboard/players/{$ban->id}/unban")}}" class="ml-2 d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning">{{__('nav.unban')}}</button>
                        </form>
                    </td>
                @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
