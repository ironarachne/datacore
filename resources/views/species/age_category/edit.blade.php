@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Age Category</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="age-category-edit-form" method="POST"
                      action="{{ route('species.update_age_category', ['species' => $species, 'age_category' => $ageCategory]) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $ageCategory->name }}">
                    </div>
                    <div class="form-group">
                        <label for="age_min">Age Min</label>
                        <input type="number" id="age_min" name="age_min" class="form-control"
                               value="{{ $ageCategory->age_min }}">
                    </div>
                    <div class="form-group">
                        <label for="age_max">Age Max</label>
                        <input type="number" id="age_max" name="age_max" class="form-control"
                               value="{{ $ageCategory->age_max }}">
                    </div>
                    <div class="form-group">
                        <label for="size_category">Size Category</label>
                        <select class="form-control" id="size_category" name="size_category">
                            <option @if ($ageCategory->size_category == 'tiny') selected @endif>tiny</option>
                            <option @if ($ageCategory->size_category == 'small') selected @endif>small</option>
                            <option @if ($ageCategory->size_category == 'medium') selected @endif>medium</option>
                            <option @if ($ageCategory->size_category == 'large') selected @endif>large</option>
                            <option @if ($ageCategory->size_category == 'huge') selected @endif>huge</option>
                            <option @if ($ageCategory->size_category == 'gargantuan') selected @endif>gargantuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="height_base_female">Female Height Base</label>
                        <input type="number" id="height_base_female" name="height_base_female" class="form-control"
                               value="{{ $ageCategory->height_base_female }}">
                    </div>
                    <div class="form-group">
                        <label for="height_base_male">Male Height Base</label>
                        <input type="number" id="height_base_male" name="height_base_male" class="form-control"
                               value="{{ $ageCategory->height_base_male }}">
                    </div>
                    <div class="form-group">
                        <label for="height_range_dice">Height Range Dice</label>
                        <input type="text" id="height_range_dice" name="height_range_dice" class="form-control"
                               value="{{ $ageCategory->height_range_dice }}">
                    </div>
                    <div class="form-group">
                        <label for="weight_base_female">Female Weight Base</label>
                        <input type="number" id="weight_base_female" name="weight_base_female" class="form-control"
                               value="{{ $ageCategory->weight_base_female }}">
                    </div>
                    <div class="form-group">
                        <label for="weight_base_male">Male Weight Base</label>
                        <input type="number" id="weight_base_male" name="weight_base_male" class="form-control"
                               value="{{ $ageCategory->weight_base_male }}">
                    </div>
                    <div class="form-group">
                        <label for="weight_range_dice">Weight Range Dice</label>
                        <input type="text" id="weight_range_dice" name="weight_range_dice" class="form-control"
                               value="{{ $ageCategory->weight_range_dice }}">
                    </div>
                    <div class="form-group">
                        <label for="commonality">Commonality</label>
                        <input type="number" id="commonality" name="commonality" class="form-control"
                               value="{{ $ageCategory->commonality }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
