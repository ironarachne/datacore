<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resource "{{ $resource->name }}"
        </h2>
    </x-slot>

    <div>
        <p>{{ $resource->description }}</p>
        <p><strong>Main Material:</strong> {{ $resource->main_material }}</p>
        <p><strong>Origin:</strong> {{ $resource->origin }}</p>
        <p><strong>Commonality:</strong> {{ $resource->commonality }}</p>
        <p><strong>Value:</strong> {{ $resource->value }}</p>

        <p><strong>Tags:</strong> @foreach($resource->tags as $tag)<span class="tag">{{$tag->name}}</span> @endforeach</p>

        @if (Auth::user()->is_admin)
            <p><a href="{{ route('resource.edit', ['resource'=>$resource]) }}"
                  class="btn">Edit</a></p>
        @endif
    </div>
</x-app-layout>
