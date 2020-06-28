@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Domain: {{ $domain->name }}</h1>

                <p><strong>Appearance Traits:</strong> {{ $domain->appearance_traits }}</p>
                <p><strong>Personality Traits:</strong> {{ $domain->personality_traits }}</p>
                <p><strong>Holy Items:</strong> {{ $domain->holy_items }}</p>
                <p><strong>Holy Symbols:</strong> {{ $domain->holy_symbols }}</p>

                @if (Auth::user()->is_admin)
                    <p><a href="{{ route('domain.edit', ['domain' => $domain]) }}"
                          class="btn btn-primary">Edit</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection
