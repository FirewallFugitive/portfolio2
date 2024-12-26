<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Outfits') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Create Outfit</h3>
            <button onclick="window.location='{{ route('outfits.generate') }}'" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg mb-6">
                Generate Outfit
            </button>

            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Your Outfits</h3>
            <div class="grid grid-cols-1 gap-4">
                @foreach ($outfits as $outfit)
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow flex justify-between items-center">
                        <div>
                            <h4 class="text-gray-800 dark:text-gray-200 font-semibold">{{ $outfit->name }}</h4>
                            <p class="text-gray-500 dark:text-gray-400 mt-2">Clothing Items:</p>
                        </div>

                        <div class="flex flex-col items-end gap-2">
                            <form action="{{ route('outfits.destroy', $outfit->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this outfit?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                    Delete
                                </button>
                            </form>

                            @if (!$outfit->isPublic)
                                <form action="{{ route('outfits.share', $outfit->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">
                                        Share
                                    </button>
                                </form>
                            @else
                                <span class="text-green-500 font-semibold">Shared</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-4 mt-4">
                        @foreach (json_decode($outfit->clothing_item_ids) as $itemId)
                            @php $item = \App\Models\ClothingItem::find($itemId); @endphp
                            @if ($item)
                                <div class="text-center">
                                    <img src="data:image/jpeg;base64,{{ $item->image_data }}" 
                                        alt="{{ $item->type }}" 
                                        class="w-24 h-24 object-contain mb-2 rounded-lg">
                                    <p class="text-gray-600 dark:text-gray-300">{{ $item->type }} - {{ $item->color }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const clothingGrid = document.getElementById('clothing-grid');

        clothingGrid.addEventListener('click', (event) => {
            const item = event.target.closest('.clothing-item');

            if (item) {
                const checkbox = item.closest('label').querySelector('input[type="checkbox"]');
                const category = checkbox.getAttribute('data-category');

                const checkboxesInCategory = document.querySelectorAll(`input[data-category="${category}"]`);
                checkboxesInCategory.forEach(cb => {
                    cb.checked = false;
                    cb.closest('label').querySelector('.clothing-item').classList.remove('selected');
                });

                checkbox.checked = true;
                item.classList.add('selected');
            }
        });
    });
</script>

<style>
    .clothing-item.selected {
        background-color: #3b82f6; 
        border-color: #2563eb;
        color: white;
    }
    .clothing-item.selected p {
        color: white;
    }
</style>
