@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Alle Hashtags</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($hashtags as $hashtag)
                            <li class="list-group-item">
                                <span style="font-size: 130%;" class="mr-2 badge badge-{{ $hashtag->color}}">{{$hashtag->name}}</span>
                                ({{ $hashtag->color}})
                                <a class="ml-2 btn btn-sm btn-outline-primary" href="/hashtag/{{ $hashtag->id }}/edit"><i class="fas fa-edit"></i>Bearbeiten</a>
                                <form style="display: inline;" action="/hashtag/{{ $hashtag->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-outline-danger btn-sm" type="submit" value="Löschen">
                                </form>
                            </li>
                        @endforeach
                    </ul> 
                    <a class="btn btn-success btn-sm mt-3" href="/hashtag/create"><i class="fas fa-plus-circle"></i>Neues Hashtag anlegen</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
