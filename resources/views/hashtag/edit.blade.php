@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hashtag bearbeiten</div>

                <div class="card-body">
                    <form action = "/hashtag/{{ $hashtag->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control {{$errors->has('name') ? 'border-danger' : ''}}" id="name" name="name" value="{{old('name') ?? $hashtag->name }}">
                            <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="color">Farbe</label>
                            <textarea class="form-control {{$errors->has('color') ? 'border-danger' : ''}}" id="color" name="color" rows="5">{{old('color') ?? $hashtag->color }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('color') !!}</small>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="absenden">
                    </form>
                    <a class="btn btn-primary btn-sm mt-3 float-right" href="/hashtag"><i class="fas fa-arrow-circle-up"></i> Zurück</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
