<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">{{ $news->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Published on: {{ $news->publication_date }}
                    </p>
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="rounded-md">
                    </div>
                    <div class="mt-6 text-gray-800 dark:text-gray-200">
                        {{ $news->content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
