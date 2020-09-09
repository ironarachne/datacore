<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Species
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="species-creation-form" method="POST" action="{{ route('species.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="plural_name">Plural Name</label>
                <input type="text" id="plural_name" name="plural_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="adjective">Adjective</label>
                <input type="text" id="adjective" name="adjective" class="form-control">
            </div>
            <div class="form-group">
                <label for="humidity_min">Min Humidity</label>
                <input id="humidity_min" name="humidity_min" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="humidity_max">Max Humidity</label>
                <input id="humidity_max" name="humidity_max" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="temperature_min">Min Temperature</label>
                <input id="temperature_min" name="temperature_min" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="temperature_max">Max Temperature</label>
                <input id="temperature_max" name="temperature_max" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="commonality">Commonality</label>
                <input id="commonality" name="commonality" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" class="form-control">
            </div>
            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</x-app-layout>
