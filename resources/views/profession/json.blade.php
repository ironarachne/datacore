@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Process Profession JSON Data</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <p>@{{ message }}</p>

                        <h2 class="card-title">Process JSON Data</h2>
                        <p>The JSON must have a parent entity "professions" that contains an array of properly-formatted pattern.</p>
                        <input type="hidden" ref="jsonType" value="professions">
                        <div class="form-group">
                            <label for="json-data">JSON</label>
                            <textarea class="form-control" id="json-data" rows="12" v-model="jsonData"></textarea>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" id="create-from-json" v-on:click="createFromJson" :disabled="!jsonData">Process</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
