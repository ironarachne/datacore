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

                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">Biomes: <span
                            class="badge badge-primary badge-pill">{{ $biomeCount }}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Charges: <span
                            class="badge badge-primary badge-pill">{{ $chargeCount }}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Domains: <span
                            class="badge badge-primary badge-pill">{{ $domainCount }}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Minerals: <span
                            class="badge badge-primary badge-pill">{{ $mineralCount }}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Patterns: <span
                            class="badge badge-primary badge-pill">{{ $patternCount }}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Professions: <span
                            class="badge badge-primary badge-pill">{{ $professionCount }}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Resources: <span
                            class="badge badge-primary badge-pill">{{ $resourceCount }}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Species: <span
                            class="badge badge-primary badge-pill">{{ $speciesCount }}</span></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
