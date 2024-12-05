<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inbox') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <!-- All Messages Table -->
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Sender
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Message
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach($messages as $message)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <!-- Sender -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $message->sender->profile_picture ?? 'https://picsum.photos/50' }}" alt="{{ $message->sender->name }}">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $message->sender->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $message->sender->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <!-- Message Content -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-300">
                                        <!-- Parent Message for Replies -->
                                        @if($message->parentMessage)
                                            <blockquote class="italic text-gray-400 dark:text-gray-500 border-l-4 border-gray-300 pl-4 mb-2">
                                                <strong>Replying to:</strong> "{{ $message->parentMessage->content }}"
                                            </blockquote>
                                        @endif

                                        <!-- Message Content -->
                                        <p>{{ $message->content }}</p>

                                        <!-- Replies to Sent Messages -->
                                        @if($message->replies->isNotEmpty())
                                            <div class="mt-4">
                                                <strong>Replies:</strong>
                                                @foreach($message->replies as $reply)
                                                    <div class="mt-2 pl-4 border-l-2 border-gray-300">
                                                        <p class="italic text-gray-400">From: {{ $reply->sender->name }}</p>
                                                        <p>{{ $reply->content }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <!-- Actions -->
                                <td class="px-6 py-4 text-right">
                                    <!-- Reply Form -->
                                    <form action="{{ route('messages.reply') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="sender_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="receiver_id" value="{{ $message->sender->id }}">
                                        <input type="hidden" name="reply_to_id" value="{{ $message->id }}">
                                        <textarea name="content" rows="1" class="mt-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Type your reply here..." required></textarea>
                                        <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                            Reply
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
