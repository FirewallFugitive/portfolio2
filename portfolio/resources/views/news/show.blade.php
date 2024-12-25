<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold">{{ $news->title }}</h2>
                <p class="text-sm text-gray-500">Published on: {{ $news->publication_date }}</p>
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $news->image) }}" class="rounded-md">
                </div>
                <p class="mt-4">{{ $news->content }}</p>
            </div>

            <!-- Comments Section -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold">Comments</h3>
                @foreach($news->comments as $comment)
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-md mt-4">
                        <p>{{ $comment->comment }}</p>
                        <p class="text-sm text-gray-500">By {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</p>
                    </div>
                @endforeach

                @auth
                    <form method="POST" action="{{ route('news.comment.store', $news->id) }}" class="mt-6">
                        @csrf
                        <textarea name="comment" class="w-full rounded-md" rows="4" placeholder="Add a comment..." required></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
                    </form>
                @else
                    <p class="mt-4 text-sm">Please <a href="{{ route('login') }}" class="text-blue-500">log in</a> to comment.</p>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
