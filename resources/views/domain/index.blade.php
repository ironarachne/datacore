@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Domains</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p><a href="{{ route('domain.create') }}" class="btn btn-primary">Create New</a></p>

                <h2>List of Domains</h2>
                <ul>
                    @foreach ($domains as $domain)
                        <li>
                            <a href="{{ route('domain.show', ['domain' => $domain]) }}">{{ $domain->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
