<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mb-6 bg-gray-800 p-4 rounded-lg shadow-lg">
                <form action="{{ route('news.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="keyword" 
                            placeholder="Search by keyword..." 
                            value="{{ request('keyword') }}" 
                            class="w-full rounded-lg bg-gray-700 text-white p-2 focus:ring-2 focus:ring-light-blue"
                        >
                    </div>

                    <div>
                        <input 
                            type="date" 
                            name="date" 
                            value="{{ request('date') }}" 
                            class="rounded-lg bg-gray-700 text-white p-2 focus:ring-2 focus:ring-light-blue"
                        >
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="bg-light-blue text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            @foreach($news as $item)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                            {!! request('keyword') 
                            ? str_replace(request('keyword'), "<mark class='bg-yellow-300 text-black'>".e(request('keyword'))."</mark>", $item->title) 
                            : $item->title !!}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Published on:
                            <span class="{{ request('date') === $item->publication_date ? 'bg-yellow-300 text-black px-2 rounded' : '' }}">
                                {{ $item->publication_date }}
                            </span>
                        </p>
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="rounded-md">
                        </div>
                        <p class="mt-4 text-gray-800 dark:text-gray-200">
                            {{ Str::limit($item->content, 150, '...') }}
                        </p>
                        <!-- Likes & Dislikes -->
                        <div class="mt-4 flex items-center space-x-4">
                            <form action="{{ route('news.react', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="like">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                    👍 {{ $item->reactions->where('type', 'like')->count() }}
                                </button>
                            </form>

                            <form action="{{ route('news.react', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="dislike">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                    👎 {{ $item->reactions->where('type', 'dislike')->count() }}
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('news.show', $item->id) }}" class="text-blue-500 hover:underline mt-2 block">
                            Read More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
