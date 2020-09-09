<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show Domain "{{ $domain->name }}"
        </h2>
    </x-slot>

    <div>
        <h1>Domain: {{ $domain->name }}</h1>

        <p><strong>Appearance Traits:</strong> {{ $domain->appearance_traits }}</p>
        <p><strong>Personality Traits:</strong> {{ $domain->personality_traits }}</p>
        <p><strong>Holy Items:</strong> {{ $domain->holy_items }}</p>
        <p><strong>Holy Symbols:</strong> {{ $domain->holy_symbols }}</p>

        @if (Auth::user()->is_admin)
            <p><a href="{{ route('domain.edit', ['domain' => $domain]) }}"
                  class="btn">Edit</a></p>
        @endif
    </div>
</x-app-layout>
