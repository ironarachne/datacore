<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Quick Race
        </h2>
    </x-slot>

    <div id="app">
        <div class="form-group">
            <label for="quick-species">Species Name</label>
            <input type="text" id="quick-species" name="quick-species" class="form-control" placeholder="species name"
                   v-model="quickSpecies">
            <button class="btn" id="create-quick-race" v-on:click="createQuickRace">Create
                Race
            </button>
        </div>

        <p>@{{ message }}</p>

        @if (Auth::user())
            <input type="hidden" ref="apiToken" value="{{ Auth::user()->api_token }}">
        @endif
    </div>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
