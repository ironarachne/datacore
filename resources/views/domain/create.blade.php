<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Domain
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="domain-creation-form" method="POST" action="{{ route('domain.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="appearance_traits">Appearance Traits</label>
                <input type="text" id="appearance_traits" name="appearance_traits" class="form-control">
            </div>
            <div class="form-group">
                <label for="personality_traits">Personality Traits</label>
                <input type="text" id="personality_traits" name="personality_traits" class="form-control">
            </div>
            <div class="form-group">
                <label for="holy_items">Holy Items</label>
                <input type="text" id="holy_items" name="holy_items" class="form-control">
            </div>
            <div class="form-group">
                <label for="holy_symbols">Holy Symbols</label>
                <input type="text" id="holy_symbols" name="holy_symbols" class="form-control">
            </div>
            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</x-app-layout>
