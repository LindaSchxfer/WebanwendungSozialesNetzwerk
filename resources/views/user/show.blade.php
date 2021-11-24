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
                    <a class="btn btn-success btn-sm mt-3" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i>Zurück zur Übersicht</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
