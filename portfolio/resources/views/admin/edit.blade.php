<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit FAQ') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="block w-full border-gray-300 rounded-md">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $faq->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                <input type="text" name="question" id="question" class="block w-full border-gray-300 rounded-md" value="{{ $faq->question }}" required>
            </div>
            <div class="mt-4">
                <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                <textarea name="answer" id="answer" class="block w-full border-gray-300 rounded-md" rows="4" required>{{ $faq->answer }}</textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update FAQ</button>
            </div>
        </form>
    </div>
</x-app-layout>
