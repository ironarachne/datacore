@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Create Pattern</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="pattern-creation-form" method="POST" action="{{ route('pattern.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name_template">Name Template</label>
                        <input type="text" id="name_template" name="name_template" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="main_material_override">Main Material Override</label>
                        <input type="text" id="main_material_override" name="main_material_override" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="origin_override">Origin Override</label>
                        <input type="text" id="origin_override" name="origin_override" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="commonality">Commonality</label>
                        <input type="number" id="commonality" name="commonality" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="value">Value</label>
                        <input type="number" id="value" name="value" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="professions">Professions</label>
                        <select multiple id="professions" name="professions[]" class="form-control">
                            @foreach($professions as $profession)
                                <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input id="tags" name="tags" type="text" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
