<x-app-layout>
<body>
    <form method="POST" action="/projects" class="container">
        @csrf

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Project
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <label>Title</label>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <label>Description</label>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-button class="ml-4">
                    {{ __('Create') }}
                </x-button>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('projects') }}">

                    {{ __('Cancel') }}
                </a>
            </div>

        </div>
    </form>
</body>
</x-app-layout>
