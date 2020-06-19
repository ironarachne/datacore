@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Dashboard</h1>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <p><strong>Biomes:</strong> {{ $biomeCount }}</p>
            <p><strong>Charges:</strong> {{ $chargeCount }}</p>
            <p><strong>Domains:</strong> {{ $domainCount }}</p>
            <p><strong>Minerals:</strong> {{ $mineralCount }}</p>
            <p><strong>Patterns:</strong> {{ $patternCount }}</p>
            <p><strong>Professions:</strong> {{ $professionCount }}</p>
            <p><strong>Resources:</strong> {{ $resourceCount }}</p>
            <p><strong>Species:</strong> {{ $speciesCount }}</p>
        </div>
    </div>
</div>
@endsection
