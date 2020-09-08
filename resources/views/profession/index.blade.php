@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Professions</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (Auth::user()->is_admin)
                <p>
                    <a href="{{ route('profession.create') }}" class="btn btn-primary">Create New</a>
                    <a href="{{ route('profession.json') }}" class="btn btn-info">Create from JSON</a>
                </p>
                @endif

                <h2>List of Professions</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($professions as $profession)
                        <tr>
                            <td><a href="{{ route('profession.show', ['profession' => $profession]) }}">{{ $profession->name }}</a></td>
                            <td>{{ $profession->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $professions->links() }}
            </div>
        </div>
    </div>
@endsection
