@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Profil bearbeiten</div>

                <div class="card-body">
                    <form autocomplete="off" action = "/user/{{ $user->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="profil_name">Profilname</label>
                            <input type="text" class="form-control {{$errors->has('profil_name') ? 'border-danger' : ''}}" id="profil_name" name="profil_name" value="{{old('profil_name') ?? $user->profil_name }}">
                            <small class="form-text text-danger">{!! $errors->first('profil_name') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Bild</label>
                            <input type="file" class="form-control {{$errors->has('bild') ? 'border-danger' : ''}}" id="bild" name="bild" value="">
                            <small class="form-text text-danger">{!! $errors->first('bild') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="steckbrief">Steckbrief</label>
                            <textarea class="form-control" id="steckbrief" name="steckbrief" rows="5">{{ $user->steckbrief ?? old('steckbrief') }}</textarea>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="absenden">
                    </form>
                    <a class="btn btn-primary btn-sm mt-3 float-right" href="/home"></i> Zurück</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
