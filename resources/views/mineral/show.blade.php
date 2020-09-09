<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mineral "{{ $mineral->name }}"
        </h2>
    </x-slot>

    <div>
        <h1>Mineral: {{ $mineral->name }}</h1>

        <p><strong>Hardness:</strong> {{ $mineral->hardness }}</p>
        <p><strong>Malleability:</strong> {{ $mineral->malleability }}</p>
        <p><strong>Commonality:</strong> {{ $mineral->commonality }}</p>

        <p><strong>Tags:</strong> @foreach($mineral->tags as $tag)<span
                class="tag">{{$tag->name}}</span> @endforeach</p>

        @if(sizeof($mineral->resources) > 0)
            <h2>Resources</h2>

            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Main Material</th>
                    <th>Origin</th>
                    <th>Tags</th>
                </tr>
                </thead>
                <tbody>
                @foreach($mineral->resources as $resource)
                    <tr>
                        <td>{{ $resource->name }}</td>
                        <td>{{ $resource->description }}</td>
                        <td>{{ $resource->main_material }}</td>
                        <td>{{ $resource->origin }}</td>
                        <td>@foreach($resource->tags as $tag)<span class="tag">{{$tag->name}}</span> @endforeach</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if (Auth::user()->is_admin)
            <p><a href="{{ route('mineral.edit', ['mineral'=> $mineral]) }}"
                  class="btn">Edit</a></p>
        @endif
    </div>
</x-app-layout>
