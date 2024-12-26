<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shared Outfits') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Shared Outfits</h3>
            <div class="grid grid-cols-1 gap-4">
                @foreach ($outfits as $outfit)
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                        <h4 class="text-gray-800 dark:text-gray-200 font-semibold">{{ $outfit->name }}</h4>
                        <p class="text-gray-500 dark:text-gray-400">Clothing Items:</p>
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
