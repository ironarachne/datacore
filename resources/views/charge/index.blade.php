@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Charges</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p><a href="{{ route('charge.create') }}" class="btn btn-primary">Create New</a></p>

                <div class="card">
                    <div class="card-body">
                        <p>@{{ message }}</p>

                        <h2 class="card-title">Process JSON Data</h2>
                        <p>The JSON must have a parent entity "charge" that contains an array of properly-formatted charge.</p>
                        <div class="form-group">
                            <label for="charge-json">JSON</label>
                            <textarea class="form-control" id="charge-json" rows="12" v-model="chargeJson"></textarea>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" id="charge-from-json" v-on:click="createChargesFromJson" :disabled="!chargeJson">Process</button>
                        </div>
                    </div>
                </div>

                <h2>List of Charges</h2>
                <ul>
                    @foreach ($charges as $charge)
                        <li>
                            <a href="{{ route('charge.show', ['charge' => $charge]) }}">{{ $charge->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
