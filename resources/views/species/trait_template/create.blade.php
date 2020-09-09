<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Trait Template for {{ $species->name }}
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="resource-creation-form" method="POST"
              action="{{ route('species.store_trait_template', ['species' => $species]) }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="possible_values">Possible Values</label>
                <input type="text" id="possible_values" name="possible_values" class="form-control">
            </div>
            <div class="form-group">
                <label for="possible_descriptors">Possible Descriptors</label>
                <input type="text" id="possible_descriptors" name="possible_descriptors" class="form-control">
            </div>
            <div class="form-group">
                <label for="trait_type">Trait Type</label>
                <select class="form-control" id="trait_type" name="trait_type">
                    <option>common</option>
                    <option>possible</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" class="form-control">
            </div>
            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</x-app-layout>
