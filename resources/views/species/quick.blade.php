@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Create Quick Race</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <p>@{{ message }}</p>

                        <div class="form-group">
                            <input type="text" id="quick-species" class="form-control" placeholder="species name"
                                   v-model="quickSpecies">
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" id="create-quick-race" v-on:click="createQuickRace">Create
                                Race
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
