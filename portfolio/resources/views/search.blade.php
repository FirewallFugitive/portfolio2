<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <form action="{{ route('search.users') }}" method="GET">
            <input type="text" name="search" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" placeholder="Search Users..." value="{{ request('search') }}">
        </form>
        
        @if($users->isNotEmpty())
            <div class="mt-4">
                <ul class="list-disc pl-5">
                    @foreach ($users as $user)
                        <li class="mt-2">
                            <strong>{{ $user->name }}</strong>
                            @if($user->profile_picture)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="mt-1 block w-40 h-40 object-cover">
                                </div>
                            @else
                                <div class="mt-2">
                                    <img src="https://picsum.photos/id/237/200/200" alt="Default Profile Picture" >
                                </div>
                            @endif

                            <div class="mt-2">
                                <div class="bg-gray-200 p-4 rounded-lg border border-gray-300 shadow-md max-w-2xl break-words">
                                    {{ $user->about_me }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="mt-4 text-gray-500">No users found matching your search criteria.</p>
        @endif
    </div>
</x-app-layout>