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
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    required 
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-3/4"
                    placeholder="Your name"
                >
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    required 
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-3/4"
                    placeholder="Your email address"
                >
            </div>
            <div>
                <label for="messages" class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Message</label>
                <textarea 
                    name="messages" 
                    id="messages" 
                    required 
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-3/4 h-32"
                    placeholder="Write your message here..."
                ></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">
                Send Message
            </button>
        </form>
    </div>
</x-app-layout>
