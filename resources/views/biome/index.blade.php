<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Biomes
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (Auth::user()->is_admin)
            <p class="flex">
                <a href="{{ route('biome.create') }}" class="btn">Create New</a>
                <a href="{{ route('biome.json') }}" class="btn">Create from JSON</a>
            </p>
        @endif

        <h2>List of Biomes</h2>

        <table>
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
                    <td><a href="{{ route('biome.show', ['biome' => $biome]) }}"
                                                    class="text-green-700 underline hover:no-underline">{{ $biome->name }}</a>
                    </td>
                    <td>{{ $biome->fauna_prevalence }}/{{ $biome->vegetation_prevalence }}</td>
                    <td>{{ $biome->altitude_min }} to {{ $biome->altitude_max }}</td>
                    <td>{{ $biome->temperature_min }} to {{ $biome->temperature_max }}</td>
                    <td>{{ $biome->precipitation_min }} to {{ $biome->precipitation_max }}</td>
                    <td>@foreach($biome->tags as $tag)<span class="tag">{{$tag->name}}</span> @endforeach</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $biomes->links() }}
    </div>
</x-app-layout>
