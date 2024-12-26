<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Closet') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Upload Clothing</h3>
            <form action="{{ route('clothing.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
                @csrf
                <input type="file" name="image" required>
                <select name="type" required>
                    <option value="Top">Top</option>
                    <option value="Bottom">Bottom</option>
                    <option value="Shoes">Shoes</option>
                    <option value="Hat">Hat</option>
                </select>
                <input type="text" name="color" placeholder="Color">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Upload</button>
            </form>

            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Your Clothing</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($clothingItems as $item)
                    <div class="bg-white dark:bg-gray-700 p-2 rounded-lg shadow">
                        <!-- Tiny images with uniform scaling -->
                        <img src="data:image/jpeg;base64,{{ $item->image_data }}" 
                            alt="Clothing Image" 
                            class="w-20 h-20 object-contain rounded-lg mb-2">
                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $item->type }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $item->color }}</p>
                        <form action="{{ route('clothing.destroy', $item->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
