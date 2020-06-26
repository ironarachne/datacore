@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Species</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p><a href="{{ route('species.create') }}" class="btn btn-primary">Create New</a></p>

                <div class="card">
                    <div class="card-body">
                        <p>@{{ message }}</p>

                        <h2 class="card-title">Quick Species Creation</h2>
                        <div class="form-group">
                            <input type="text" id="quick-species" class="form-control" placeholder="species name" v-model="quickSpecies">
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" id="create-quick-race" v-on:click="createQuickRace">Create Race</button>
                        </div>

                        <h2 class="card-title">Process JSON Data</h2>
                        <p>The JSON must have a parent entity "species" that contains an array of properly-formatted species.</p>
                        <div class="form-group">
                            <label for="species-json">JSON</label>
                            <textarea class="form-control" id="species-json" rows="12" v-model="speciesJson"></textarea>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" id="species-from-json" v-on:click="createSpeciesFromJson" :disabled="!speciesJson">Process</button>
                        </div>
                    </div>
                </div>

                <h2>List of Species</h2>

                <ul>
                    @foreach ($species as $spe)
                        <li><a href="{{ route('species.show', ['species'=>$spe->id]) }}">{{ $spe->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
