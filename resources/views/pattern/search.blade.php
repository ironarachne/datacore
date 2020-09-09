<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pattern Search Results
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('pattern.search') }}">
            @csrf
            <div class="shadow flex m-4 items-center p-3">
                <h3 class="block mx-2 font-bold">Search</h3>
                <input type="text" name="name" class="border-3 border-gray-600 p-2"
                       placeholder="name to search for">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>

        <h2>Search Results</h2>

        <ul>
            @foreach ($patterns as $pattern)
                <li>
                    <a class="text-green-700 underline hover:no-underline" href="{{ route('pattern.show', ['pattern' => $pattern->id]) }}">{{ $pattern->name }}</a>
                </li>
            @endforeach
        </ul>

        {{ $patterns->links() }}
    </div>
</x-app-layout>
