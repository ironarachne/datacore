@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Create Age Category for {{ $species->name }}</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="resource-creation-form" method="POST" action="{{ route('species.store_age_category', ['species' => $species]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="age_min">Age Min</label>
                        <input type="number" id="age_min" name="age_min" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="age_max">Age Max</label>
                        <input type="number" id="age_max" name="age_max" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="size_category">Size Category</label>
                        <select class="form-control" id="size_category" name="size_category">
                            <option>tiny</option>
                            <option>small</option>
                            <option selected>medium</option>
                            <option>large</option>
                            <option>huge</option>
                            <option>gargantuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="height_base_female">Female Height Base</label>
                        <input type="number" id="height_base_female" name="height_base_female" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="height_base_male">Male Height Base</label>
                        <input type="number" id="height_base_male" name="height_base_male" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="height_range_dice">Height Range Dice</label>
                        <input type="text" id="height_range_dice" name="height_range_dice" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="weight_base_female">Female Weight Base</label>
                        <input type="number" id="weight_base_female" name="weight_base_female" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="weight_base_male">Male Weight Base</label>
                        <input type="number" id="weight_base_male" name="weight_base_male" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="weight_range_dice">Weight Range Dice</label>
                        <input type="text" id="weight_range_dice" name="weight_range_dice" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="commonality">Commonality</label>
                        <input type="number" id="commonality" name="commonality" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
