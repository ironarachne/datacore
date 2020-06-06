@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Biomes</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p><a href="{{ route('biome.create') }}" class="btn btn-primary">Create New</a></p>

                <h2>List of Biomes</h2>
                <ul>
                @foreach ($biomes as $biome)
                    <li><a href="{{ route('biome.show', ['biome'=>$biome->id]) }}">{{ $biome->name }}</a></li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
