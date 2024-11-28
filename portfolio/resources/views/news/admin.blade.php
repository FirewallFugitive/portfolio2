<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Add New News Button -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a href="{{ route('news.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-md">
                        Add New News
                    </a>
                </div>
            </div>

            <!-- News List -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl mx-auto">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-6">News Items</h3>
                    <table class="w-full border-collapse border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Title</th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Publication Date</th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                                <tr class="text-gray-800 dark:text-gray-200">
                                    <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                        {{ $item->title }}
                                    </td>
                                    <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                        {{ $item->publication_date }}
                                    </td>
                                    <td class="border border-gray-200 dark:border-gray-700 px-4 py-2 flex space-x-2">
                                        <a href="{{ route('news.show', $item->id) }}" 
                                           class="px-4 py-2 bg-blue-500 text-white rounded-md">
                                            View
                                        </a>
                                        <a href="{{ route('news.edit', $item->id) }}" 
                                           class="px-4 py-2 bg-yellow-500 text-white rounded-md">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('news.destroy', $item->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-red-500 text-white rounded-md"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
