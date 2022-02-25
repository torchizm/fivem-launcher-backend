@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-4">
            <div class="card">
                <div class="card-header">{{ __('nav.products')}}</div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        @if($products)
                            @foreach ($products as $product)
                                <li class="list-group-item"><a href="{{ $product->path() }}" class="nav-link text-eviolet">{{$product->name}}</a></li>
                            @endforeach
                        @endif

                        <li class="list-group-item"><a href="{{ url('/dashboard/product/add') }}" class="nav-link text-eviolet"><i class="fas fa-plus text-eviolet"></i> {{ __('nav.addProduct') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">{{__('nav.dashboard')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('nav.loggedIn')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
