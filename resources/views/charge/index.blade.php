@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Charges</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p><a href="{{ route('charge.create') }}" class="btn btn-primary">Create New</a></p>

                <h2>List of Charges</h2>
                <ul>
                    @foreach ($charges as $charge)
                        <li>
                            <a href="{{ route('charge.show', ['charge' => $charge]) }}">{{ $charge->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
