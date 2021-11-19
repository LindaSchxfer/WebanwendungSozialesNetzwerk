@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Alle Posts</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($posts as $post)
                            <li class="list-group-item">{{$post->name}} {{$post->beschreibung}}
                                <form style="display: inline;" action="/post/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="ml-2 btn btn-outline-danger btn-sm float-right" type="submit" value="Löschen">
                                </form>
                                <a class="ml-2 btn btn-sm btn-outline-primary float-right" href="/post/{{ $post->id }}/edit"><i class="fas fa-edit"></i>Bearbeiten</a>
                            </li>
                        @endforeach
                    </ul> 
                    <a class="btn btn-success btn-sm mt-3" href="/post/create"><i class="fas fa-plus-circle"></i>Neuen Post anlegen</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
