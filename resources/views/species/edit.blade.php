@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Species</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="species-edit-form" method="POST"
                      action="{{ route('species.update', ['species' => $species]) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $species->name }}">
                    </div>
                    <div class="form-group">
                        <label for="plural_name">Plural Name</label>
                        <input type="text" id="plural_name" name="plural_name" class="form-control"
                               value="{{ $species->plural_name }}">
                    </div>
                    <div class="form-group">
                        <label for="adjective">Adjective</label>
                        <input type="text" id="adjective" name="adjective" class="form-control"
                               value="{{ $species->adjective }}">
                    </div>
                    <div class="form-group">
                        <label for="humidity_min">Min Humidity</label>
                        <input id="humidity_min" name="humidity_min" type="number" class="form-control"
                               value="{{ $species->humidity_min }}">
                    </div>
                    <div class="form-group">
                        <label for="humidity_max">Max Humidity</label>
                        <input id="humidity_max" name="humidity_max" type="number" class="form-control"
                               value="{{ $species->humidity_max }}">
                    </div>
                    <div class="form-group">
                        <label for="temperature_min">Min Temperature</label>
                        <input id="temperature_min" name="temperature_min" type="number" class="form-control"
                               value="{{ $species->temperature_min }}">
                    </div>
                    <div class="form-group">
                        <label for="temperature_max">Max Temperature</label>
                        <input id="temperature_max" name="temperature_max" type="number" class="form-control"
                               value="{{ $species->temperature_max }}">
                    </div>
                    <div class="form-group">
                        <label for="commonality">Commonality</label>
                        <input id="commonality" name="commonality" type="number" class="form-control"
                               value="{{ $species->commonality }}">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input id="tags" name="tags" type="text" class="form-control" value="{{ $tags }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

                <h2>Age Categories</h2>

                <a href="{{ route('species.create_age_category', ['species' => $species]) }}" class="btn btn-primary">Add</a>

                <ul>
                    @foreach($species->ageCategories as $ageCategory)
                        <li>
                            <a href="{{ route('species.edit_age_category', ['species' => $species, 'age_category' => $ageCategory]) }}">{{ $ageCategory->name }}</a>
                        </li>
                    @endforeach
                </ul>

                <h2>Trait Templates</h2>

                <a href="{{ route('species.create_trait_template', ['species' => $species]) }}" class="btn btn-primary">Add</a>

                <ul>
                    @foreach($species->traitTemplates as $traitTemplate)
                        <li>
                            <a href="{{ route('species.edit_trait_template', ['species' => $species, 'trait_template' => $traitTemplate]) }}">{{ $traitTemplate->name }}</a>
                        </li>
                    @endforeach
                </ul>

                <h2>Resources</h2>

                <a href="{{ route('species.create_resource', ['species' => $species]) }}"
                   class="btn btn-primary">Add</a>

                <ul>
                    @foreach($species->resources as $resource)
                        <li>
                            <a href="{{ route('species.edit_resource', ['species' => $species, 'resource' => $resource]) }}">{{ $resource->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
