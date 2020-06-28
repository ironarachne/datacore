@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $profession->name }}</h1>

                <p>{{ $profession->description }}</p>

                <p><strong>Tags:</strong> @foreach($profession->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>

                @if (Auth::user()->is_admin)
                <p><a href="{{ route('profession.edit', ['profession'=>$profession]) }}"
                      class="btn btn-primary">Edit</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection
