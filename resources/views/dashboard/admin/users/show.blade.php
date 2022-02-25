@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-4">
            <div class="card">
                <div class="card-header"> <a href="/dashboard">/{{__('nav.dashboard')}}</a>/{{__('nav.users')}}</div>

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
        <div class="col-8">
            @if ($currentUser)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                        @can('update', $currentUser)
                        <form method="POST" action="{{$currentUser->path() . '/delete'}}" class="ml-2 d-inline">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm text-cultured">{{__('nav.ban')}}</button>
                        </form>
                        @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('message'))
                        <div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								{{ session('message') }}
						</div>
                        @endif
                        <h1>@if ($currentUser->name)
                                    {{$currentUser->name}}
                                @else
                                    {{$currentUser->email}}
                                @endif</h1>
                        <hr>
                        <p>Email: {{$currentUser->email}}</p>
                        <p>Launcher Count: {{$currentUser->launchers()->count()}}</p>
                        <p>Server Count: {{$currentUser->servers()->count()}}</p>
                        <p>{{__('nav.createdAt')}}: {{$currentUser->created_at->diffForHumans()}}</p>
                        <p>{{__('nav.updatedAt')}}: {{$currentUser->updated_at->diffForHumans()}}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
