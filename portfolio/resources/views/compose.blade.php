<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compose Message') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-4">Send a Message to {{ $receiver->name }}</h3>
            <form action="{{ route('message.send') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="sender_id" value="{{ auth()->id() }}">
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message:</label>
                    <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded shadow">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
