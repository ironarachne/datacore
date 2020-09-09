<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profession: "{{ $profession->name }}"
        </h2>
    </x-slot>

    <div>
        <p>{{ $profession->description }}</p>

        <p><strong>Tags:</strong> @foreach($profession->tags as $tag)<span class="tag">{{$tag->name}}</span> @endforeach</p>

        @if (Auth::user()->is_admin)
            <p><a href="{{ route('profession.edit', ['profession'=>$profession]) }}"
                  class="btn">Edit</a></p>
        @endif
    </div>
</x-app-layout>
