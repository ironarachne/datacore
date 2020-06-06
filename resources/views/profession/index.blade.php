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
                <p><a href="{{ route('profession.create') }}" class="btn btn-primary">Create New</a></p>

                <h2>List of Professions</h2>
                <ul>
                    @foreach ($professions as $profession)
                        <li>
                            <a href="{{ route('profession.show', ['profession'=>$profession->id]) }}">{{ $profession->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
