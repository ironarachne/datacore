<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Minerals
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
                <a href="{{ route('mineral.create') }}" class="btn">Create New</a>
                <a href="{{ route('mineral.json') }}" class="btn">Create from JSON</a>
            </p>
        @endif

        <h2>List of Minerals</h2>
        <ul>
            @foreach ($minerals as $mineral)
                <li>
                    <a class="text-green-700 underline hover:no-underline"
                       href="{{ route('mineral.show', ['mineral' => $mineral->id]) }}">{{ $mineral->name }}</a>
                </li>
            @endforeach
        </ul>

        {{ $minerals->links() }}
    </div>
</x-app-layout>
