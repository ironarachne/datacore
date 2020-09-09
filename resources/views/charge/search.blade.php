<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Results - Charges
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('charge.search') }}">
            @csrf
            <div class="shadow flex m-4 items-center p-3">
                <h2 class="block mx-2 font-bold">Search</h2>

                <input type="text" name="name" class="border-3 border-gray-600 p-2"
                       placeholder="name to search for">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>

        <h2>Search Results</h2>

        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Mask Image</th>
                <th>Lines Image</th>
                <th>Tags</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($charges as $charge)
                <tr>
                    <td><a
                            href="{{ route('charge.show', ['charge' => $charge]) }}"
                            class="text-green-700 underline hover:no-underline">{{ $charge->name }}</a></td>
                    <td><img
                            src="https://static.ironarachne.com/images/heraldry/sources/charges/{{ $charge->identifier }}.png"
                            class="w-20 h-20"></td>
                    <td><img
                            src="https://static.ironarachne.com/images/heraldry/sources/charges/{{ $charge->identifier }}-lines.png"
                            class="w-20 h-20"></td>
                    <td>@foreach($charge->tags as $tag) <span class="tag">{{ $tag->name }}</span> @endforeach</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $charges->links() }}
    </div>
</x-app-layout>
