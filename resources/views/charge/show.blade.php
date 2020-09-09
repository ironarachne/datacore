<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show Charge "{{ $charge->name }}"
        </h2>
    </x-slot>

    <div>
        <h1>{{ $charge->name }}</h1>

        <p><strong>Identifier:</strong> {{ $charge->identifier }}</p>
        <p><strong>Noun (Plural):</strong> {{ $charge->noun }} ({{ $charge->noun_plural }})</p>
        @if($charge->descriptor)
            <p><strong>Descriptor:</strong> {{ $charge->descriptor }}</p>
        @endif
        @if($charge->single_only)
            <p><strong>Single Only</strong></p>
        @endif

        <p><strong>Tags:</strong> @foreach($charge->tags as $tag)<span
                class="tag">{{$tag->name}}</span> @endforeach</p>

        @if (Auth::user()->is_admin)
            <p><a href="{{ route('charge.edit', ['charge' => $charge]) }}"
                  class="btn">Edit</a></p>
        @endif
    </div>
</x-app-layout>
