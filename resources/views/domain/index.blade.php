<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Domains
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
                <a href="{{ route('domain.create') }}" class="btn">Create New</a>
                <a href="{{ route('domain.json') }}" class="btn">Create from JSON</a>
            </p>
        @endif

        <h2>List of Domains</h2>

        <ul>
            @foreach ($domains as $domain)
                <li>
                    <a class="text-green-700 underline hover:no-underline"
                       href="{{ route('domain.show', ['domain' => $domain]) }}">{{ $domain->name }}</a>
                </li>
            @endforeach
        </ul>

        {{ $domains->links() }}
    </div>
</x-app-layout>
