@extends('layouts.app')

@section('title', 'Startseite')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Startseite') }}</div>

                <div class="card-body">

                    
                    <h2>Willkommen bei lindagram!</h2>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
