<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Species Search
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('species.search') }}">
            @csrf
            <div class="shadow flex m-4 items-center p-3">
                <h3 class="block mx-2 font-bold">Search</h3>
                <input type="text" name="name" class="border-3 border-gray-600 p-2"
                       placeholder="name to search for">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>

        <h2>Search Results</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Tags</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($species as $spe)
                <tr>
                    <td><a class="text-green-700 underline hover:no-underline" href="{{ route('species.show', ['species'=>$spe->id]) }}">{{ $spe->name }}</a></td>
                    <td>@foreach($spe->tags as $tag)<span class="tag">{{ $tag->name }}</span> @endforeach</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $species->links() }}
    </div>
</x-app-layout>
