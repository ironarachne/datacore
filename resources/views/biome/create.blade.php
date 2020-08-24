@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Biomes</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form id="biome-creation-form" method="POST" action="{{ route('biome.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Biome Name</label>
                                <input id="name" name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="fauna_prevalence">Fauna Prevalence</label>
                                <input id="fauna_prevalence" name="fauna_prevalence" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="vegetation_prevalence">Flora Prevalence</label>
                                <input id="vegetation_prevalence" name="vegetation_prevalence" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="altitude_max">Max Altitude</label>
                                <input id="altitude_max" name="altitude_max" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="altitude_min">Min Altitude</label>
                                <input id="altitude_min" name="altitude_min" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="temperature_max">Max Temperature</label>
                                <input id="temperature_max" name="temperature_max" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="temperature_min">Min Temperature</label>
                                <input id="temperature_min" name="temperature_min" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="precipitation_max">Max Precipitation</label>
                                <input id="precipitation_max" name="precipitation_max" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="precipitation_min">Min Precipitation</label>
                                <input id="precipitation_min" name="precipitation_min" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="possible_landmarks">Possible Landmarks</label>
                                <input id="possible_landmarks" name="possible_landmarks" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input id="tags" name="tags" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option>terrestrial</option>
                                    <option>marine</option>
                                    <option>freshwater</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
