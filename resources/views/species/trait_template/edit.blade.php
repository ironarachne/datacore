@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Trait Template</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="resource-creation-form" method="POST"
                      action="{{ route('species.store_trait_template', ['species' => $species, 'trait_template' => $traitTemplate]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{ $traitTemplate->name }}">
                    </div>
                    <div class="form-group">
                        <label for="possible_values">Possible Values</label>
                        <input type="text" id="possible_values" name="possible_values" class="form-control"
                               value="{{ $traitTemplate->possible_values }}">
                    </div>
                    <div class="form-group">
                        <label for="possible_descriptors">Possible Descriptors</label>
                        <input type="text" id="possible_descriptors" name="possible_descriptors" class="form-control"
                               value="{{ $traitTemplate->possible_descriptors }}">
                    </div>
                    <div class="form-group">
                        <label for="trait_type">Trait Type</label>
                        <select class="form-control" id="trait_type" name="trait_type">
                            <option @if($traitTemplate->trait_type == 'common') selected @endif>common</option>
                            <option @if($traitTemplate->trait_type == 'possible') selected @endif>possible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input id="tags" name="tags" type="text" class="form-control" value="{{ $tags }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
