<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resources
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (!empty($tag))
            <p>Showing only resources with tag "{{ $tag }}".</p>
        @endif

        @if (Auth::user()->is_admin)
            <p class="flex">
                <a href="{{ route('resource.create') }}" class="btn">Create New</a>
                <a href="{{ route('resource.json') }}" class="btn">Create from JSON</a>
                <!--UI to show the Delete button-->
                <button onclick="document.getElementById('id01').style.display='block'">Modal</button>
            </p>
        
</div>
                             
                             <script>
                             // Get the modal
                             var modal = document.getElementById('id01');
                             // When the user clicks anywhere outside of the modal, close it
                                window.onclick = function(event) {
                                    if (event.target == modal) {
                                        modal.style.display = "none";
                                                         }
                                            }
                                </script>
        @endif

        <form method="POST" action="{{ route('resource.search') }}">
            @csrf
            <div class="shadow flex m-4 items-center p-3">
                <h3 class="block mx-2 font-bold">Search</h3>
                <input type="text" name="name" class="border-3 border-gray-600 p-2"
                       placeholder="name to search for">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>

        <h2>List of Resources</h2>

        <ul>
            @foreach ($resources as $resource)
                <li>
                    <a class="text-green-700 underline hover:no-underline" href="{{ route('resource.show', ['resource'=>$resource->id]) }}">{{ $resource->name }}</a>
                </li>
            @endforeach
        </ul>

        {{ $resources->links() }}
    </div>
</x-app-layout>
