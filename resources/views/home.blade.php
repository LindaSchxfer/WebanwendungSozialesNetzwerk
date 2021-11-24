@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2>Hallo {{ auth()->user()->name }}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    @isset($posts)
                        @if($posts->count() > 0)
                            <h5>Deine Posts</h5>
                        @endif
                        <ul class="list-group">
                            @foreach ($posts as $post)
                                <li class="list-group-item">
                                    <form style="display: inline;" action="/post/{{ $post->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="ml-2 btn btn-outline-danger btn-sm float-right" type="submit" value="Löschen">
                                    </form>
                                    <a class="ml-2 btn btn-sm btn-outline-primary float-right" href="/post/{{ $post->id }}/edit"><i class="fas fa-edit"></i>Bearbeiten</a>
                                    <a class="ml-2 float-right" href="/post/{{ $post->id }}">Detailansicht</a>

                                    <b><a href="/user/{{$post->user->id}}"> {{ $post->user->name}} </a></b></span> 
                                    <br>
                                    {{$post->name}} <br> {{$post->beschreibung}} <br>   
                                    @foreach ($post->hashtags as $hashtag)
                                        <a class="badge badge-{{$hashtag->color}}" href="/post/hashtag/{{ $hashtag->id }}">{{ $hashtag->name }}</a>
                                    @endforeach <br>
                                        <div style="font-size: 80%; font-color:#707070;" class="float-left">{{ $post->created_at->diffForHumans()}}</div><br>
                                </li>
                            @endforeach
                        </ul> 
                    @endisset

                    <a class="btn btn-success btn-sm" href="/post/create">Neuen Beitrag verfassen</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
