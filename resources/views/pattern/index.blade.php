@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Patterns</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (Auth::user()->is_admin)
                <p><a href="{{ route('pattern.create') }}" class="btn btn-primary">Create New</a></p>

                <div class="card">
                    <div class="card-body">
                        <p>@{{ message }}</p>

                        <h2 class="card-title">Process JSON Data</h2>
                        <p>The JSON must have a parent entity "pattern" that contains an array of properly-formatted pattern.</p>
                        <input type="hidden" ref="jsonType" value="patterns">
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

                <h2>List of Patterns</h2>
                <ul>
                    @foreach ($patterns as $pattern)
                        <li>
                            <a href="{{ route('pattern.show', ['pattern' => $pattern->id]) }}">{{ $pattern->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
