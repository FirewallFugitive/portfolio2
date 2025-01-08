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
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow flex justify-between items-start">
                        <!-- Left Section: Outfit Details -->
                        <div class="flex-1">
                            <h4 class="text-gray-800 dark:text-gray-200 font-semibold">{{ $outfit->name }}</h4>
                            <p class="text-gray-500 dark:text-gray-400 mt-2 mb-4">Clothing Items:</p>
                            <div class="flex flex-col items-center gap-4">
                                @php 
                                    $items = collect(json_decode($outfit->clothing_item_ids))->map(function ($itemId) {
                                        return \App\Models\ClothingItem::find($itemId);
                                    })->filter();
                                @endphp

                                <!-- Top -->
                                @if ($items->where('type', 'Top')->first())
                                    @php $item = $items->where('type', 'Top')->first(); @endphp
                                    <div class="text-center">
                                        <img src="data:image/jpeg;base64,{{ $item->image_data }}" 
                                            alt="{{ $item->type }}" 
                                            class="w-24 h-24 object-contain mb-2 rounded-lg">
                                        <p class="text-gray-600 dark:text-gray-300">{{ $item->type }} - {{ $item->color }}</p>
                                    </div>
                                @endif

                                <!-- Bottom -->
                                @if ($items->where('type', 'Bottom')->first())
                                    @php $item = $items->where('type', 'Bottom')->first(); @endphp
                                    <div class="text-center">
                                        <img src="data:image/jpeg;base64,{{ $item->image_data }}" 
                                            alt="{{ $item->type }}" 
                                            class="w-24 h-24 object-contain mb-2 rounded-lg">
                                        <p class="text-gray-600 dark:text-gray-300">{{ $item->type }} - {{ $item->color }}</p>
                                    </div>
                                @endif

                                <!-- Shoes -->
                                @if ($items->where('type', 'Shoes')->first())
                                    @php $item = $items->where('type', 'Shoes')->first(); @endphp
                                    <div class="text-center">
                                        <img src="data:image/jpeg;base64,{{ $item->image_data }}" 
                                            alt="{{ $item->type }}" 
                                            class="w-24 h-24 object-contain mb-2 rounded-lg">
                                        <p class="text-gray-600 dark:text-gray-300">{{ $item->type }} - {{ $item->color }}</p>
                                    </div>
                                @endif

                                <!-- Hat -->
                                @if ($items->where('type', 'Hat')->first())
                                    @php $item = $items->where('type', 'Hat')->first(); @endphp
                                    <div class="text-center">
                                        <img src="data:image/jpeg;base64,{{ $item->image_data }}" 
                                            alt="{{ $item->type }}" 
                                            class="w-24 h-24 object-contain mb-2 rounded-lg">
                                        <p class="text-gray-600 dark:text-gray-300">{{ $item->type }} - {{ $item->color }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Section: Buttons -->
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
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
