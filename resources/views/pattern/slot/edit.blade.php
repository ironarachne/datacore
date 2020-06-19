@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Slot</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="pattern-slot-edit-form" method="POST"
                      action="{{ route('pattern.update_slot', ['pattern' => $pattern, 'slot' => $slot]) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $slot->name }}">
                    </div>
                    <div class="form-group">
                        <label for="required_tag">Required Tag</label>
                        <input type="text" id="required_tag" name="required_tag" class="form-control" value="{{ $slot->required_tag }}">
                    </div>
                    <div class="form-group">
                        <label for="description_template">Description Template</label>
                        <input type="text" id="description_template" name="description_template" class="form-control" v-pre value="{{ $slot->description_template }}">
                    </div>
                    <div class="form-group">
                        <label for="possible_quirks">Possible Quirks</label>
                        <input type="text" id="possible_quirks" name="possible_quirks" class="form-control" value="{{ $slot->possible_quirks }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
