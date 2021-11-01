@extends('layouts.app')

@section('title', 'Startseite')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Startseite') }}</div>

                <div class="card-body">

                    Willkommen bei lindagram!

                    <span class="btn btn-primary"><i class="fas fa-plus"></i>Hallo</span>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
