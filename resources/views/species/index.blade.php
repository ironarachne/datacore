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
                @if (Auth::user()->is_admin)
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
                        <input type="hidden" ref="jsonType" value="species">
                        <div class="form-group">
                            <label for="json-data">JSON</label>
                            <textarea class="form-control" id="json-data" rows="12" v-model="jsonData"></textarea>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" id="create-from-json" v-on:click="createFromJson" :disabled="!jsonData">Process</button>
                        </div>
                    </div>
                </div>
                @endif

                <h2>List of Species</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($species as $spe)
                        <tr>
                            <td><a href="{{ route('species.show', ['species'=>$spe->id]) }}">{{ $spe->name }}</a></td>
                            <td>{{ convert_tags_to_string($spe) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
