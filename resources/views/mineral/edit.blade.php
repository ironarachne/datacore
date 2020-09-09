<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mineral "{{ $mineral->name }}"
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="mineral-edit-form" method="POST" action="{{ route('mineral.update', ['mineral'=>$mineral]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $mineral->name }}">
            </div>
            <div class="form-group">
                <label for="plural_name">Plural Name</label>
                <input type="text" id="plural_name" name="plural_name" class="form-control"
                       value="{{ $mineral->plural_name }}">
            </div>
            <div class="form-group">
                <label for="hardness">Hardness</label>
                <input type="number" id="hardness" name="hardness" class="form-control"
                       value="{{ $mineral->hardness }}">
            </div>
            <div class="form-group">
                <label for="malleability">Malleability</label>
                <input type="number" id="malleability" name="malleability" class="form-control"
                       value="{{ $mineral->malleability }}">
            </div>
            <div class="form-group">
                <label for="commonality">Commonality</label>
                <input type="number" id="commonality" name="commonality" class="form-control"
                       value="{{ $mineral->commonality }}">
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" class="form-control" value="{{ $tags }}">
            </div>
            <button type="submit" class="btn">Save</button>
        </form>

        <h2>Resources</h2>

        <p><a href="{{ route('mineral.create_resource', ['mineral' => $mineral]) }}"
              class="btn">Add</a></p>

        @if(sizeof($mineral->resources) > 0)
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Main Material</th>
                    <th>Origin</th>
                    <th>Tags</th>
                </tr>
                </thead>
                <tbody>
                @foreach($mineral->resources as $resource)
                    <tr>
                        <td>{{ $resource->name }}</td>
                        <td>{{ $resource->description }}</td>
                        <td>{{ $resource->main_material }}</td>
                        <td>{{ $resource->origin }}</td>
                        <td>@foreach($resource->tags as $tag)<span class="tag">{{$tag->name}}</span> @endforeach</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
