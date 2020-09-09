<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Mineral
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="bg-red-700" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="mineral-creation-form" method="POST" action="{{ route('mineral.store') }}">
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
                <label for="hardness">Hardness</label>
                <input type="number" id="hardness" name="hardness" class="form-control">
            </div>
            <div class="form-group">
                <label for="malleability">Malleability</label>
                <input type="number" id="malleability" name="malleability" class="form-control">
            </div>
            <div class="form-group">
                <label for="commonality">Commonality</label>
                <input type="number" id="commonality" name="commonality" class="form-control">
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" class="form-control">
            </div>
            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</x-app-layout>
