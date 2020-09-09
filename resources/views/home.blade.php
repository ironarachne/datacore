<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div>
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <ul class="flex flex-wrap">
            <li class="block text-center">Biomes: <span class="badge">{{ $biomeCount }}</span></li>
            <li class="block text-center">Charges: <span class="badge">{{ $chargeCount }}</span></li>
            <li class="block text-center">Domains: <span class="badge">{{ $domainCount }}</span></li>
            <li class="block text-center">Minerals: <span class="badge">{{ $mineralCount }}</span></li>
            <li class="block text-center">Patterns: <span class="badge">{{ $patternCount }}</span></li>
            <li class="block text-center">Professions: <span class="badge">{{ $professionCount }}</span></li>
            <li class="block text-center">Resources: <span class="badge">{{ $resourceCount }}</span></li>
            <li class="block text-center">Species: <span class="badge">{{ $speciesCount }}</span></li>
        </ul>
    </div>
</x-app-layout>
