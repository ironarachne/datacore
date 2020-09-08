@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Species</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (Auth::user()->is_admin)
                <p>
                    <a href="{{ route('species.create') }}" class="btn btn-primary">Create New</a>
                    <a href="{{ route('species.json') }}" class="btn btn-info">Create from JSON</a>
                </p>
                @endif

                <h2>List of Species</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($species as $spe)
                        <tr>
                            <td><a href="{{ route('species.show', ['species'=>$spe->id]) }}">{{ $spe->name }}</a></td>
                            <td>{{ convert_tags_to_string($spe) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
