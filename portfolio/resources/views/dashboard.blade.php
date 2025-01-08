<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shared Outfits') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <!-- Search Bar -->
            <form action="{{ route('dashboard') }}" method="GET" class="mb-6">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search users, outfits, or colors..." 
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full p-2 dark:bg-gray-700 dark:text-gray-300">
            </form>

            <!-- Outfits -->
            <div class="grid grid-cols-1 gap-4">
                @forelse ($outfits as $outfit)
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                        <h4 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                            {!! $search 
                                ? str_replace(
                                    $search, 
                                    "<mark class='bg-yellow-300 text-black'>".e($search)."</mark>", 
                                    e($outfit->name)
                                ) 
                                : e($outfit->name) !!}
                        </h4>
                        <p class="text-gray-500 dark:text-gray-400">Created by: 
                            <a href="{{ route('user.profile', $outfit->user->id) }}" class="text-blue-500 hover:underline">
                                {!! $search 
                                    ? str_replace(
                                        $search, 
                                        "<mark class='bg-yellow-300 text-black'>".e($search)."</mark>", 
                                        e($outfit->user->name)
                                    ) 
                                    : e($outfit->user->name) !!}
                            </a>
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 mb-4">Clothing Items:</p>
                        <div class="flex flex-col items-center gap-4">
                            @foreach ($outfit->clothingItems as $item)
                                <div class="text-center">
                                    <img src="data:image/jpeg;base64,{{ $item->image_data }}" 
                                        alt="{{ $item->type }}" 
                                        class="w-24 h-24 object-contain mb-2 rounded-lg">
                                    <p class="text-gray-600 dark:text-gray-300">
                                        {!! $search 
                                            ? str_replace(
                                                $search, 
                                                "<mark class='bg-yellow-300 text-black'>".e($search)."</mark>", 
                                                e($item->type . ' - ' . $item->color)
                                            ) 
                                            : e($item->type . ' - ' . $item->color) !!}
                                    </p>
                                </div>
                            @endforeach
                        </div>


                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No outfits match your search criteria.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
