@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $species->name }}</h1>

                <p><strong>Plural:</strong> {{ $species->plural_name }}</p>

                <p><strong>Adjective:</strong> {{ $species->adjective }}</p>

                <p><strong>Commonality:</strong> {{ $species->commonality }}</p>

                <p><strong>Temperature Range:</strong> {{ $species->temperature_min }}-{{ $species->temperature_max }}</p>

                <p><strong>Humidity Range:</strong> {{ $species->humidity_min }}-{{ $species->humidity_max }}</p>

                <p><strong>Tags:</strong> @foreach($species->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>

                @if (Auth::user()->is_admin)
                <p><a href="{{ route('species.edit', ['species' => $species]) }}"
                      class="btn btn-primary">Edit</a></p>
                @endif

                @if(sizeof($species->resources) > 0)
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
                    @foreach($species->resources as $resource)
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

                @if(sizeof($species->ageCategories) > 0)
                <h2>Age Categories</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age Range</th>
                            <th>Average Male Height</th>
                            <th>Average Male Weight</th>
                            <th>Average Female Height</th>
                            <th>Average Female Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($species->ageCategories as $ageCategory)
                        <tr>
                            <td>{{ $ageCategory->name }}</td>
                            <td>{{ $ageCategory->age_min }}-{{ $ageCategory->age_max }}</td>
                            <td>{{ $ageCategory->averageMaleHeight() }}</td>
                            <td>{{ $ageCategory->averageMaleWeight() }} lbs.</td>
                            <td>{{ $ageCategory->averageFemaleHeight() }}</td>
                            <td>{{ $ageCategory->averageFemaleWeight() }} lbs.</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif

                @if(sizeof($species->traitTemplates) > 0)
                <h2>Trait Templates</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Possible Values</th>
                            <th>Possible Descriptors</th>
                            <th>Type</th>
                            <th>Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($species->traitTemplates as $traitTemplate)
                        <tr>
                            <td>{{ $traitTemplate->name }}</td>
                            <td>{{ $traitTemplate->possible_values }}</td>
                            <td v-pre>{{ $traitTemplate->possible_descriptors }}</td>
                            <td>{{ $traitTemplate->trait_type }}</td>
                            <td>@foreach($traitTemplate->tags as $tag){{$tag->name}}@if (!$loop->last), @endif @endforeach</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
@endsection
