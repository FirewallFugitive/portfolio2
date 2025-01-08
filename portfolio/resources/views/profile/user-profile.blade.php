<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Profile') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <!-- User Info -->
            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">User Information</h3>
            <p class="text-gray-700 dark:text-gray-300"><strong>Name:</strong> {{ $user->name }}</p>
            <p class="text-gray-700 dark:text-gray-300"><strong>Email:</strong> {{ $user->email }}</p>

            <!-- Message Box -->
            <div class="mt-4">
                <form method="POST" action="{{ route('message.send') }}">
                    @csrf
                    <input type="hidden" name="sender_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                    <div class="mt-4">
                        <a href="{{ route('message.compose', $user->id) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                            Send Message
                        </a>
                    </div>
                </form>
            </div>

            <!-- Public Outfits -->
            <h3 class="mt-6 mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Public Outfits</h3>
            <div class="grid grid-cols-1 gap-4">
                @foreach ($outfits as $outfit)
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                        <h4 class="text-gray-800 dark:text-gray-200 font-semibold">{{ $outfit->name }}</h4>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 mb-4">Clothing Items:</p>
                        <div class="flex flex-col items-center gap-4">
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
