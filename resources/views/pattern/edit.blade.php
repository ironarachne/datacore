<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pattern "{{ $pattern->name }}"
        </h2>
    </x-slot>

    <div>
        <h1>Edit Pattern</h1>

        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="pattern-edit-form" method="POST" action="{{ route('pattern.update', ['pattern' => $pattern]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $pattern->name }}">
            </div>
            <div class="form-group">
                <label for="name_template">Name Template</label>
                <input type="text" id="name_template" name="name_template" class="form-control" v-pre
                       value="{{ $pattern->name_template }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control"
                       value="{{ $pattern->description }}">
            </div>
            <div class="form-group">
                <label for="main_material_override">Main Material Override</label>
                <input type="text" id="main_material_override" name="main_material_override" class="form-control"
                       value="{{ $pattern->main_material_override }}">
            </div>
            <div class="form-group">
                <label for="origin_override">Origin Override</label>
                <input type="text" id="origin_override" name="origin_override" class="form-control"
                       value="{{ $pattern->origin_override }}">
            </div>
            <div class="form-group">
                <label for="commonality">Commonality</label>
                <input type="number" id="commonality" name="commonality" class="form-control"
                       value="{{ $pattern->commonality }}">
            </div>
            <div class="form-group">
                <label for="value">Value</label>
                <input type="number" id="value" name="value" class="form-control" value="{{ $pattern->value }}">
            </div>
            <div class="form-group">
                <label for="professions">Professions</label>
                <select multiple id="professions" name="professions[]" class="form-control">
                    @foreach($professions as $profession)
                        <option value="{{ $profession->id }}"
                                @if($pattern->professions->contains($profession->id))selected @endif>{{ $profession->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" class="form-control" value="{{ $tags }}">
            </div>
            <button type="submit" class="btn">Save</button>
        </form>

        <h2>Slots</h2>
        <a href="{{ route('pattern.create_slot', ['pattern' => $pattern]) }}"
           class="btn">Add</a>

        <ul>
            @foreach($pattern->slots as $slot)
                <li>
                    <a href="{{ route('pattern.edit_slot', ['pattern' => $pattern, 'slot' => $slot]) }}">{{ $slot->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
