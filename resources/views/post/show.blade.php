@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post Detailansicht</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <p><b>{{ $post->name}}</b></p> 
                            <p>{{ $post->beschreibung}}</p> 
                            @if($post->hashtags->count() > 0)
                            <p>
                                <b>Verknüpfte Hashtags:</b> (Klicken, zum entfernen)<br>
                                @foreach ($post->hashtags as $hashtag)
                                    <a class="badge badge-{{$hashtag->color}}" href="/post/{{ $post->id }}/hashtag/{{ $hashtag->id }}/detach">{{ $hashtag->name }}</a>
                                @endforeach
                            </p>
                            @endif
                            <p>
                                <b>Verfügbare Hashtags:</b> (Klicken, zum hinzufügen)<br>
                                @foreach ($availableHashtags as $hashtag)
                                    <a class="badge badge-{{$hashtag->color}}" href="/post/{{ $post->id }}/hashtag/{{ $hashtag->id }}/attach">{{ $hashtag->name }}</a>
                                @endforeach
                            </p>
                        </div>
                        <div class="col-md-3">
                                <img class="img-fluid" src="/img/400x300.jpg" alt="">
                            </a>
                        </div>
                    </div>

                    <!-- Zurück link wird nicht angezeigt, wenn ich von der User Detailseite komme -->
                    @if( !(strstr( URL::previous(), '/user/' )))
                        <a class="btn btn-success btn-sm mt-3" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i>Zurück</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
