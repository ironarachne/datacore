@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Resources</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (!empty($tag))
                    <p>Showing only resources with tag "{{ $tag }}".</p>
                @endif

                @if (Auth::user()->is_admin)
                <p><a href="{{ route('resource.create') }}" class="btn btn-primary">Create New</a></p>
                @endif

                <h2>List of Resources</h2>
                <ul>
                    @foreach ($resources as $resource)
                        <li>
                            <a href="{{ route('resource.show', ['resource'=>$resource->id]) }}">{{ $resource->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
