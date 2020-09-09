<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profession "{{ $profession->name }}"
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="profession-edit-form" method="POST"
              action="{{ route('profession.update', ['profession'=>$profession]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $profession->name }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control"
                       value="{{ $profession->description }}">
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" class="form-control" value="{{ $tags }}">
            </div>
            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</x-app-layout>
