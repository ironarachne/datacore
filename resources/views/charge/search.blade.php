@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Charge Search</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Search</h2>
                        <form method="POST" action="{{ route('charge.search') }}">
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
                        <th>Mask Image</th>
                        <th>Lines Image</th>
                        <th>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($charges as $charge)
                        <tr>
                            <td><a href="{{ route('charge.show', ['charge' => $charge]) }}">{{ $charge->name }}</a></td>
                            <td><img src="https://static.ironarachne.com/images/heraldry/sources/charges/{{ $charge->identifier }}.png" class="heraldry-image"></td>
                            <td><img src="https://static.ironarachne.com/images/heraldry/sources/charges/{{ $charge->identifier }}-lines.png" class="heraldry-image"></td>
                            <td>{{ convert_tags_to_string($charge) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $charges->links() }}
            </div>
        </div>
    </div>
@endsection
