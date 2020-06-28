@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $mineral->name }}</h1>

                <p><strong>Hardness:</strong> {{ $mineral->hardness }}</p>
                <p><strong>Malleability:</strong> {{ $mineral->malleability }}</p>
                <p><strong>Commonality:</strong> {{ $mineral->commonality }}</p>

                <p><strong>Tags:</strong> @foreach($mineral->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>

                @if(sizeof($mineral->resources) > 0)
                    <h2>Resources</h2>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Main Material</th>
                            <th>Origin</th>
                            <th>Tags</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mineral->resources as $resource)
                            <tr>
                                <td>{{ $resource->name }}</td>
                                <td>{{ $resource->description }}</td>
                                <td>{{ $resource->main_material }}</td>
                                <td>{{ $resource->origin }}</td>
                                <td>@foreach($resource->tags as $tag){{$tag->name}}@if (!$loop->last), @endif @endforeach</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if (Auth::user()->is_admin)
                <p><a href="{{ route('mineral.edit', ['mineral'=> $mineral]) }}"
                      class="btn btn-primary">Edit</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection
