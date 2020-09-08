@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Species Search</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Search</h2>
                        <form method="POST" action="{{ route('species.search') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name to search for</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>

                <h2>Search Results</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($species as $spe)
                        <tr>
                            <td><a href="{{ route('species.show', ['species'=>$spe->id]) }}">{{ $spe->name }}</a></td>
                            <td>{{ convert_tags_to_string($spe) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $species->links() }}
            </div>
        </div>
    </div>
@endsection
