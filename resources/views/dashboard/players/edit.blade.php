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
                    <form method="POST" action="{{ $player->editPath() . '/edit' }}">
                        @csrf
                        <div class="form-group row">
                            <label for="until" class="col-md-2 form-label text-md-right">{{ __('nav.permission')}}</label>
                            <select class="form-control col-6" name="permission" id="permission">
                                @foreach ($permissions as $permission)
                                    @if ($permission->id == $currentPermission)
                                        <option value="{{$permission->id}}" selected>{{$permission->name}}</option>
                                    @else
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                    @endif
                                @endforeach
                          </select>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
							<div class="col-md-6 offset-md-2">
								<button type="submit" class="btn btn-grullo text-cultured">Kaydet</button>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
