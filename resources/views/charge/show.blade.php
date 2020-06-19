@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $charge->name }}</h1>

                <p><strong>Identifier:</strong> {{ $charge->identifier }}</p>
                <p><strong>Noun (Plural):</strong> {{ $charge->noun }} ({{ $charge->noun_plural }})</p>
                @if($charge->descriptor)
                <p><strong>Descriptor:</strong> {{ $charge->descriptor }}</p>
                @endif
                @if($charge->single_only)
                    <p><strong>Single Only</strong></p>
                @endif

                <p><strong>Tags:</strong> @foreach($charge->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>

                <p><a href="{{ route('charge.edit', ['charge' => $charge]) }}"
                      class="btn btn-primary">Edit</a></p>
            </div>
        </div>
    </div>
@endsection
