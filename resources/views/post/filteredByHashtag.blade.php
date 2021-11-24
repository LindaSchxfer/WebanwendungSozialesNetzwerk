@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Alle Posts mit dem Hashtag <span style="font-size: 120%" class="ml-2 badge badge-{{$hashtag->color}}">{{$hashtag->name}}</span>
                    <a class="float-right" href="/post">Zurück zu allen Posts</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($posts as $post)
                        
                            <li class="list-group-item">
                                <a href="/user/{{ $post->user->id }}"><img src="/img/thumb_hoch.jpg"></a>
                                <br>
                                {{$post->name}} {{$post->beschreibung}}

                                <span class="mx-2"><b> Von <a href="/user/{{$post->user->id}}"> {{ $post->user->name}} </a></b></span>

                                <form style="display: inline;" action="/post/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="ml-2 btn btn-outline-danger btn-sm float-right" type="submit" value="Löschen">
                                </form>
                                <a class="ml-2 btn btn-sm btn-outline-primary float-right" href="/post/{{ $post->id }}/edit"><i class="fas fa-edit"></i>Bearbeiten</a>
                                <div class="float-right">{{ $post->created_at->diffForHumans() . " gepostet" }}</div><br>
                                @foreach ($post->hashtags as $hashtag)
                                    <a class="badge badge-{{$hashtag->color}}" href="/post/hashtag/{{ $hashtag->id }}">{{ $hashtag->name }}</a>
                                @endforeach
                            </li>
                        @endforeach
                    </ul> 
                    @auth
                    <a class="btn btn-success btn-sm mt-3" href="/post/create"><i class="fas fa-plus-circle"></i>Neuen Post anlegen</a>
                    @endauth
                    <div class="mt-3">
                            {{ $posts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
