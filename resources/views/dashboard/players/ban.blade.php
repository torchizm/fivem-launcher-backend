@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-8">
            <div class="card">
            <div class="card-header">{{$player->username}}</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								{{ session('message') }}
						</div>
                    @endif
                    <form method="POST" action="{{ $player->banPath() . '/ban' }}">
                         @csrf
                        <div class="form-group row">
							<label for="reason" class="col-md-2 col-form-label text-md-right">{{ __('nav.reason') }}</label>
							<div class="col-md-6">
								<textarea id="reason" type="text" class="form-control" name="reason" maxlength="300"></textarea>
							</div>
						</div>
                        <div class="form-group row">
                            <label for="until" class="col-md-2 form-label text-md-right">{{ __('nav.until')}}</label>
                            <select class="form-control col-6" name="until" id="until">
                                @foreach ($days as $day)
                                @if ($day > 4000)
                                    <option value="{{$day}}">{{__('nav.perma')}}</option>
                                @else
                                    <option value="{{$day}}">{{$day}} {{__('nav.day')}}</option>
                                @endif
                                @endforeach
                          </select>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
							<div class="col-md-6 offset-md-2">
								<button type="submit" class="btn btn-grullo text-cultured">Ban</button>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
