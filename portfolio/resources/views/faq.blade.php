<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Frequently Asked Questions') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        @forelse ($categories as $category)
            @if ($category->faqs->isNotEmpty())
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        {{ $category->name }}
                    </h3>

                    <div class="space-y-4">
                        @foreach ($category->faqs as $faq)
                            <div class="border rounded-lg p-4 bg-gray-100 dark:bg-gray-800">
                                <p class="font-medium text-gray-900 dark:text-gray-200">{{ $faq->question }}</p>
                                <p class="mt-2 text-gray-700 dark:text-gray-400">{{ $faq->answer }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <p class="text-gray-500 dark:text-gray-400 text-center">No FAQs available.</p>
        @endforelse
    </div>
</x-app-layout>
