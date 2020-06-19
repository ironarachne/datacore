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
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Fauna/Flora Prevalence</th>
                        <th>Altitude Range</th>
                        <th>Temperature Range</th>
                        <th>Precipitation Range</th>
                        <th>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($biomes as $biome)
                        <tr>
                            <td><a href="{{ route('biome.show', ['biome' => $biome]) }}">{{ $biome->name }}</a></td>
                            <td>{{ $biome->fauna_prevalence }}/{{ $biome->vegetation_prevalence }}</td>
                            <td>{{ $biome->altitude_min }}-{{ $biome->altitude_max }}</td>
                            <td>{{ $biome->temperature_min }}-{{ $biome->temperature_max }}</td>
                            <td>{{ $biome->precipitation_min }}-{{ $biome->precipitation_max }}</td>
                            <td>@foreach($biome->tags as $tag){{$tag->name}}@if (!$loop->last), @endif @endforeach</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
