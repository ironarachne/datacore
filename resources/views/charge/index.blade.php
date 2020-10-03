<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Charges
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (Auth::user()->is_admin)
            <p class="flex">
                <a href="{{ route('charge.create') }}" class="btn">Create New</a>
                <a href="{{ route('charge.json') }}" class="btn">Create from JSON</a>
            </p>
        @endif

        <form method="POST" action="{{ route('charge.search') }}">
            @csrf
            <div class="shadow flex m-4 items-center p-3">
                <h2 class="block mx-2 font-bold">Search</h2>

                <input type="text" name="name" class="border-3 border-gray-600 p-2"
                       placeholder="name to search for">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>

        <h2>List of Charges</h2>

        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Mask Image</th>
                <th>Lines Image</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($charges as $charge)
                <tr>
                    <td><a
                            href="{{ route('charge.show', ['charge' => $charge]) }}"
                            class="text-green-700 underline hover:no-underline">{{ $charge->name }}</a></td>
                    <td><img
                            src="https://static.ironarachne.com/images/heraldry/sources/charges/{{ $charge->identifier }}.png"
                            class="w-20 h-20"></td>
                    <td><img
                            src="https://static.ironarachne.com/images/heraldry/sources/charges/{{ $charge->identifier }}-lines.png"
                            class="w-20 h-20"></td>
                    <td>@foreach($charge->tags as $tag) <span class="tag">{{ $tag->name }}</span> @endforeach</td>
                     <form id="delete-form{{$charge->id}}" action="{{url('/charge')}}/{{$charge->id}}" method="post">
                        {{csrf_field() }}
                        {{ method_field('DELETE') }}   
                        <i  onclick="return deletecharge({{$charge->id}});" class="fa fa-trash-o" style="cursor: pointer;"></i>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $charges->links() }}
    </div>
    <script type="text/javascript">
            var deletecharge = function(id){
                    if (confirm('Are you sure you want to delete this?')) {
                event.preventDefault();
                document.getElementById('delete-form'+id).submit(); 
                }           
        }
    </script>

</x-app-layout>
