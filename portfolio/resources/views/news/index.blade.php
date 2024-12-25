<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($news as $item)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                            <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Published on: {{ $item->publication_date }}
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
