<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    <div class="py-8 flex justify-center">
        <form method="POST" action="{{ route('contact') }}" class="space-y-4 w-full max-w-3xl max-h-3xl text-center">
            @csrf
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Message</label>
                <textarea 
                    name="message" 
                    id="message" 
                    required 
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-3/4 h-3/4"
                    placeholder="Write your message here..."
                ></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">
                Send Message
            </button>
        </form>
    </div>
</x-app-layout>
