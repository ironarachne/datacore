@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Biome</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="biome-edit-form" method="POST" action="{{ route('biome.update', ['biome'=>$biome]) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Biome Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $biome->name }}">
                    </div>
                    <div class="form-group">
                        <label for="fauna_prevalence">Fauna Prevalence</label>
                        <input id="fauna_prevalence" name="fauna_prevalence" type="number" class="form-control"
                               value="{{ $biome->fauna_prevalence }}">
                    </div>
                    <div class="form-group">
                        <label for="vegetation_prevalence">Flora Prevalence</label>
                        <input id="vegetation_prevalence" name="vegetation_prevalence" type="number"
                               class="form-control" value="{{ $biome->vegetation_prevalence }}">
                    </div>
                    <div class="form-group">
                        <label for="altitude_max">Max Altitude</label>
                        <input id="altitude_max" name="altitude_max" type="number" class="form-control"
                               value="{{ $biome->altitude_max }}">
                    </div>
                    <div class="form-group">
                        <label for="altitude_min">Min Altitude</label>
                        <input id="altitude_min" name="altitude_min" type="number" class="form-control"
                               value="{{ $biome->altitude_min }}">
                    </div>
                    <div class="form-group">
                        <label for="temperature_max">Max Temperature</label>
                        <input id="temperature_max" name="temperature_max" type="number" class="form-control"
                               value="{{ $biome->temperature_max }}">
                    </div>
                    <div class="form-group">
                        <label for="temperature_min">Min Temperature</label>
                        <input id="temperature_min" name="temperature_min" type="number" class="form-control"
                               value="{{ $biome->temperature_min }}">
                    </div>
                    <div class="form-group">
                        <label for="precipitation_max">Max Precipitation</label>
                        <input id="precipitation_max" name="precipitation_max" type="number" class="form-control"
                               value="{{ $biome->precipitation_max }}">
                    </div>
                    <div class="form-group">
                        <label for="precipitation_min">Min Precipitation</label>
                        <input id="precipitation_min" name="precipitation_min" type="number" class="form-control"
                               value="{{ $biome->precipitation_min }}">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input id="tags" name="tags" type="text" class="form-control" value="{{ $tags }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option @if ($biome->type == 'terrestrial') selected @endif>terrestrial</option>
                            <option @if ($biome->type == 'marine') selected @endif>marine</option>
                            <option @if ($biome->type == 'freshwater') selected @endif>freshwater</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
