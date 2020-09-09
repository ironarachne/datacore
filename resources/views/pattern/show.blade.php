<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pattern "{{ $pattern->name }}"
        </h2>
    </x-slot>

    <div>
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

        <table>
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
                    <td><a href="{{ route('resource.index') }}?tag={{ $slot->required_tag }}">{{ $slot->required_tag }}
                    </td>
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
                    <a class="text-green-700 underline hover:no-underline" href="{{ route('profession.show', ['profession' => $profession]) }}">{{ $profession->name }}</a>
                </li>
            @endforeach
        </ul>

        @if (Auth::user()->is_admin)
            <p><a href="{{ route('pattern.edit', ['pattern'=>$pattern]) }}"
                  class="btn">Edit</a></p>
        @endif
    </div>
</x-app-layout>
