@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h1>{{ $biome->name }}</h1>
                <p><strong>Type:</strong> {{ $biome->type }}</p>
                <p><strong>Fauna Prevalence:</strong> {{ $biome->fauna_prevalence }}</p>
                <p><strong>Flora Prevalence:</strong> {{ $biome->vegetation_prevalence }}</p>
                <p><strong>Altitude Range:</strong> {{ $biome->altitude_min }} - {{ $biome->altitude_max }}</p>
                <p><strong>Temperature Range:</strong> {{ $biome->temperature_min }} - {{ $biome->temperature_max }}</p>
                <p><strong>Precipitation Range:</strong> {{ $biome->precipitation_min }}
                    - {{ $biome->precipitation_max }}</p>
                <p><strong>Tags:</strong> @foreach($biome->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>
                @if (Auth::user()->is_admin)
                    <a href="{{ route('biome.edit', ['biome'=>$biome]) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>
    </div>
@endsection
