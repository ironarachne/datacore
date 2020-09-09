<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Resource from JSON
        </h2>
    </x-slot>
    <div id="app">
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <p>@{{ message }}</p>

        <p>The JSON must have a parent entity "resources" that contains an array of properly-formatted pattern.</p>

        <input type="hidden" ref="jsonType" value="resources">

        <div class="form-group">
            <label for="json-data">JSON</label>
            <textarea class="form-control" id="json-data" rows="12" v-model="jsonData"></textarea>
        </div>

        <button class="btn" id="create-from-json" v-on:click="createFromJson" :disabled="!jsonData">
            Process
        </button>
        @if (Auth::user())
            <input type="hidden" ref="apiToken" value="{{ Auth::user()->api_token }}">
        @endif
    </div>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
