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
                        <h2 class="card-title">Quick Species Creation</h2>
                        <p>@{{ message }}</p>
                        <div class="form-group">
                            <input type="text" id="quick-species" class="form-control" placeholder="species name" v-model="quickSpecies">
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" id="create-quick-race" v-on:click="createQuickRace">Create Race</button>
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
