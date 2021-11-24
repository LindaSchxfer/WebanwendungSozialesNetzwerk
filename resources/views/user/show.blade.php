@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$user->name}}</div>

                <div class="card-body">
                    <p><b>Profilname: {{$user->profil_name}}</b></p> 
                    <p>{{ $user->steckbrief}}</p> 

                    @if($user->posts->count() > 0)
                    <ul class="list-group">
                        @foreach ($user->posts as $post)
                            <li class="list-group-item">
                                <a class="ml-2 float-right" href="/post/{{ $post->id }}">Detailansicht</a>
                                <br>
                                {{$post->name}} <br> {{$post->beschreibung}} <br>   
                                @foreach ($post->hashtags as $hashtag)
                                    <a class="badge badge-{{$hashtag->color}}" href="/post/hashtag/{{ $hashtag->id }}">{{ $hashtag->name }}</a>
                                @endforeach <br>
                                    <div style="font-size: 80%; font-color:#707070;" class="float-left">{{ $post->created_at->diffForHumans()}}</div><br>
                            </li>
                        @endforeach
                    </ul> 
                    @else()
                    <p>{{ $user->name }} hat noch keine Posts angelegt.</p>
                    @endif

                    <a class="btn btn-success btn-sm mt-3" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i>Zurück</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
