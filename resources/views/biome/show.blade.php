<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Showing Biome "{{ $biome->name }}"
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h1>{{ $biome->name }}</h1>
        <p><strong>Type:</strong> {{ $biome->type }}</p>
        <p><strong>Fauna Prevalence:</strong> {{ $biome->fauna_prevalence }}</p>
        <p><strong>Flora Prevalence:</strong> {{ $biome->vegetation_prevalence }}</p>
        <p><strong>Altitude Range:</strong> {{ $biome->altitude_min }} to {{ $biome->altitude_max }}</p>
        <p><strong>Temperature Range:</strong> {{ $biome->temperature_min }} to {{ $biome->temperature_max }}</p>
        <p><strong>Precipitation Range:</strong> {{ $biome->precipitation_min }}
            - {{ $biome->precipitation_max }}</p>
        <p><strong>Possible Landmarks:</strong> {{ $biome->possible_landmarks }}</p>
        <p><strong>Tags:</strong> @foreach($biome->tags as $tag)<span
                class="tag">{{$tag->name}}</span> @endforeach</p>
        @if (Auth::user()->is_admin)
            <a href="{{ route('biome.edit', ['biome'=>$biome]) }}" class="btn">Edit</a>
        @endif
    </div>
</x-app-layout>
