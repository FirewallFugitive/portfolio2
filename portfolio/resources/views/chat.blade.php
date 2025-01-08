<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Chat with {{ $receiver->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <!-- Chat Messages -->
            <div id="chat-box" class="chat-box bg-white dark:bg-gray-700 p-4 rounded-lg shadow overflow-y-auto h-96">
                @foreach ($messages as $message)
                    <div class="{{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }} my-2">
                        <p class="inline-block px-4 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200' }}">
                            {{ $message->content }}
                        </p>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ $message->created_at->format('h:i A') }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Send Message Form -->
            <form id="chat-form" class="mt-4 flex items-center">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <textarea name="content" placeholder="Type your message..." required class="flex-grow p-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"></textarea>
                <button type="submit" class="ml-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                    Send
                </button>
            </form>
        </div>
    </div>
</x-app-layout>


<script>
    document.getElementById('chat-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = new FormData(this);

    const response = await fetch('{{ route("messages.send") }}', {
        method: 'POST',
        body: form,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    if (response.ok) {
        const data = await response.json();
        const chatBox = document.getElementById('chat-box');

        chatBox.innerHTML += `
            <div class="text-right my-2">
                <p class="inline-block px-4 py-2 rounded-lg bg-blue-500 text-white">
                    ${data.message.content}
                </p>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    ${data.time}
                </div>
            </div>
        `;

        chatBox.scrollTop = chatBox.scrollHeight;

        this.reset();
    }
});


</script>