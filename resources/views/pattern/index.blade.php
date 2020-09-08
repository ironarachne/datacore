@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Patterns</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (Auth::user()->is_admin)
                <p>
                    <a href="{{ route('pattern.create') }}" class="btn btn-primary">Create New</a>
                    <a href="{{ route('pattern.json') }}" class="btn btn-info">Create from JSON</a>
                </p>
                @endif

                <h2>List of Patterns</h2>
                <ul>
                    @foreach ($patterns as $pattern)
                        <li>
                            <a href="{{ route('pattern.show', ['pattern' => $pattern->id]) }}">{{ $pattern->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
