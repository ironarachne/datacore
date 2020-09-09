<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Professions
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
                <a href="{{ route('profession.create') }}" class="btn">Create New</a>
                <a href="{{ route('profession.json') }}" class="btn">Create from JSON</a>
            </p>
        @endif

        <h2>List of Professions</h2>

        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($professions as $profession)
                <tr>
                    <td>
                        <a class="text-green-700 underline hover:no-underline" href="{{ route('profession.show', ['profession' => $profession]) }}">{{ $profession->name }}</a>
                    </td>
                    <td>{{ $profession->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $professions->links() }}
    </div>
</x-app-layout>
