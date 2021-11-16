@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post bearbeiten</div>

                <div class="card-body">
                    <form action = "/post/{{ $post->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control {{$errors->has('name') ? 'border-danger' : ''}}" id="name" name="name" value="{{old('name') ?? $post->name }}">
                            <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="beschreibung">Beschreibung</label>
                            <textarea class="form-control {{$errors->has('beschreibung') ? 'border-danger' : ''}}" id="beschreibung" name="beschreibung" rows="5">{{old('beschreibung') ?? $post->beschreibung }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('beschreibung') !!}</small>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="absenden">
                    </form>
                    <a class="btn btn-primary btn-sm mt-3 float-right" href="/post"><i class="fas fa-arrow-circle-up"></i> Zurück</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
