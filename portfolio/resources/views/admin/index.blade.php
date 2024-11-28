<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage FAQs') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <!-- Add FAQ Button -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.faqs.create') }}" 
               class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                + Add FAQ
            </a>
        </div>

        <!-- FAQ Table -->
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Question
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Answer
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($categories as $category)
                        @foreach ($category->faqs as $faq)
                            <tr>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 dark:text-gray-200">
                                    {{ $faq->question }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 dark:text-gray-400">
                                    {{ $faq->answer }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 dark:text-gray-400">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 text-right">
      
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" 
                                       class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" 
                                          method="POST" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
