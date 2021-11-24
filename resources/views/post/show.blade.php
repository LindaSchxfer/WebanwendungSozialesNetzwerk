@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post Detailansicht</div>

                <div class="card-body">
                    <p><b>{{ $post->name}}</b></p> 
                    <p>{{ $post->beschreibung}}</p> 
                    <p>
                        @foreach ($post->hashtags as $hashtag)
                        <a class="badge badge-{{$hashtag->color}}" href="/post/hashtag/{{ $hashtag->id }}">{{ $hashtag->name }}</a>
                        @endforeach
                    </p>
                    <a class="btn btn-success btn-sm mt-3" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i>Zurück zur Übersicht</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
