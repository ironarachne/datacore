<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resource Search Results
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (!empty($tag))
            <p>Showing only resources with tag "{{ $tag }}".</p>
        @endif

        <form method="POST" action="{{ route('resource.search') }}">
            @csrf
            <div class="shadow flex m-4 items-center p-3">
                <h3 class="block mx-2 font-bold">Search</h3>
                <input type="text" name="name" class="border-3 border-gray-600 p-2"
                       placeholder="name to search for">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>
        <!--Search by Tag-->
        <form method="POST" action="{{ route('charge.searchByTag') }}">
            @csrf
            <div class="shadow flex m-4 items-center p-3">
                <h2 class="block mx-2 font-bold">Search</h2>

                <input type="text" name="tag" class="border-3 border-gray-600 p-2"
                       placeholder="tag to search for">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>
        <h2>Search Results</h2>

        <ul>
            @foreach ($resources as $resource)
                <li>
                    <a class="text-green-700 underline hover:no-underline" href="{{ route('resource.show', ['resource'=>$resource->id]) }}">{{ $resource->name }}</a>
                </li>
            @endforeach
        </ul>

        {{ $resources->links() }}
    </div>
</x-app-layout>
