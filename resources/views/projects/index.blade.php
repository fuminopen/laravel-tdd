<x-app-layout>

<body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @forelse ($projects as $project)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ $project->path() }}">{{ $project->title }}</a>
                    </div>
                @empty
                    <div class="p-6 bg-white border-b border-gray-200">
                        No Projects Yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</x-app-layout>
