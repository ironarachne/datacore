@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $resource->name }}</h1>

                <p>{{ $resource->description }}</p>
                <p><strong>Main Material:</strong> {{ $resource->main_material }}</p>
                <p><strong>Origin:</strong> {{ $resource->origin }}</p>
                <p><strong>Commonality:</strong> {{ $resource->commonality }}</p>
                <p><strong>Value:</strong> {{ $resource->value }}</p>

                <p><strong>Tags:</strong> @foreach($resource->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>

                <p><a href="{{ route('resource.edit', ['resource'=>$resource]) }}"
                      class="btn btn-primary">Edit</a></p>
            </div>
        </div>
    </div>
@endsection
