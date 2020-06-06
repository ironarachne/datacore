@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $profession->name }}</h1>

                <p>{{ $profession->description }}</p>

                <p><strong>Tags:</strong> @foreach($profession->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>

                <p><a href="{{ route('profession.edit', ['profession'=>$profession]) }}"
                      class="btn btn-primary">Edit</a></p>
            </div>
        </div>
    </div>
@endsection
