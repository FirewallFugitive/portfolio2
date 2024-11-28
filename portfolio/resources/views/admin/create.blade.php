<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add FAQ') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Select or Write a Category</label>
                <select name="category_id" id="category_id" class="block w-full border-gray-300 rounded-md">
                    <option value="">Select an existing category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <p class="text-gray-500 mt-2">Or, write a new category below:</p>
                <input type="text" name="new_category" id="new_category" class="block w-full border-gray-300 rounded-md mt-2" placeholder="Enter new category">
            </div>
            <div class="mt-4">
                <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                <input type="text" name="question" id="question" class="block w-full border-gray-300 rounded-md" required>
            </div>
            <div class="mt-4">
                <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                <textarea name="answer" id="answer" class="block w-full border-gray-300 rounded-md" rows="4" required></textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
