<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Pattern Slot
        </h2>
    </x-slot>

    <div>
        <h1>Create Slot for {{ $pattern->name }}</h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="pattern-slot-creation-form" method="POST"
              action="{{ route('pattern.store_slot', ['pattern' => $pattern]) }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="required_tag">Required Tag</label>
                <input type="text" id="required_tag" name="required_tag" class="form-control">
            </div>
            <div class="form-group">
                <label for="description_template">Description Template</label>
                <input type="text" id="description_template" name="description_template" class="form-control">
            </div>
            <div class="form-group">
                <label for="possible_quirks">Possible Quirks</label>
                <input type="text" id="possible_quirks" name="possible_quirks" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</x-app-layout>
