<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-4">Inbox for {{ $user->name }}</h1>

            <!-- List of messages -->
            <div class="space-y-4">
                @foreach($messages as $message)
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                        <p class="text-sm text-gray-600 dark:text-gray-400"><strong>From:</strong> {{ $message->sender->name }}</p>
                        <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $message->content }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Message form -->
            <div class="mt-8 p-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow">
                <form action="{{ route('message.send') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="sender_id" value="{{ $user->id }}">
                    <div>
                        <label for="receiver_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">To:</label>
                        <select name="receiver_id" id="receiver_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @foreach(\App\Models\User::all() as $otherUser)
                                <option value="{{ $otherUser->id }}">{{ $otherUser->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message:</label>
                        <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
