@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $pattern->name }}</h1>

                <p>{{ $pattern->description }}</p>
                @if(!empty($pattern->main_material_override))
                <p><strong>Main Material Override:</strong> {{ $pattern->main_material_override }}</p>
                @endif
                @if(!empty($pattern->origin_override))
                <p><strong>Origin Override:</strong> {{ $pattern->origin_override }}</p>
                @endif
                <p><strong>Tags:</strong> @foreach($pattern->tags as $tag){{$tag->name}}@if (!$loop->last)
                        , @endif @endforeach</p>

                <h2>Slots</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Required Tag</th>
                        <th>Description Template</th>
                        <th>Possible Quirks</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pattern->slots as $slot)
                        <tr>
                            <td>{{ $slot->name }}</td>
                            <td><a href="{{ route('resource.index') }}?tag={{ $slot->required_tag }}">{{ $slot->required_tag }}</td>
                            <td v-pre>{{ $slot->description_template }}</td>
                            <td>{{ $slot->possible_quirks }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h2>Professions That Can Make This</h2>
                <ul>
                    @foreach($pattern->professions as $profession)
                        <li>
                            <a href="{{ route('profession.show', ['profession' => $profession]) }}">{{ $profession->name }}</a>
                        </li>
                    @endforeach
                </ul>

                @if (Auth::user()->is_admin)
                <p><a href="{{ route('pattern.edit', ['pattern'=>$pattern]) }}"
                      class="btn btn-primary">Edit</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection
