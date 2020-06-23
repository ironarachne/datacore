@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Mineral</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="mineral-edit-form" method="POST" action="{{ route('mineral.update') }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $mineral->name }}">
                    </div>
                    <div class="form-group">
                        <label for="plural_name">Plural Name</label>
                        <input type="text" id="plural_name" name="plural_name" class="form-control" value="{{ $mineral->plural_name }}">
                    </div>
                    <div class="form-group">
                        <label for="hardness">Hardness</label>
                        <input type="number" id="hardness" name="hardness" class="form-control" value="{{ $mineral->hardness }}">
                    </div>
                    <div class="form-group">
                        <label for="malleability">Malleability</label>
                        <input type="number" id="malleability" name="malleability" class="form-control" value="{{ $mineral->malleability }}">
                    </div>
                    <div class="form-group">
                        <label for="commonality">Commonality</label>
                        <input type="number" id="commonality" name="commonality" class="form-control" value="{{ $mineral->commonality }}">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input id="tags" name="tags" type="text" class="form-control" value="{{ $tags }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

                <h2>Resources</h2>

                <a href="{{ route('mineral.create_resource', ['mineral' => $mineral]) }}"
                   class="btn btn-primary">Add</a>

                <ul>
                    @foreach($mineral->resources as $resource)
                        <li>
                            <a href="{{ route('mineral.edit_resource', ['mineral' => $mineral, 'resource' => $resource]) }}">{{ $resource->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
