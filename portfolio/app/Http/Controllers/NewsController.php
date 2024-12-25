<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Reaction;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('publication_date', 'desc')->get();
        return view('news.index', compact('news'));
    }
    public function adminIndex()
    {
        $news = News::orderBy('publication_date', 'desc')->get();
        return view('news.admin', compact('news'));
    }

    public function show(News $news)
    {
        $comments = $news->comments()->latest()->paginate(10);
        return view('news.show', compact('news', 'comments'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
            'content' => 'required|string',
            'publication_date' => 'required|date',
        ]);

        $path = $request->file('image')->store('images/news', 'public');

        News::create([
            'title' => $request->title,
            'image' => $path,
            'content' => $request->content,
            'publication_date' => $request->publication_date,
        ]);

        return redirect()->route('news.index')->with('success', 'News item created successfully.');
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'content' => 'required|string',
            'publication_date' => 'required|date',
        ]);

        $path = $news->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($news->image);
            $path = $request->file('image')->store('images/news', 'public');
        }

        $news->update([
            'title' => $request->title,
            'image' => $path,
            'content' => $request->content,
            'publication_date' => $request->publication_date,
        ]);

        return redirect()->route('news.index')->with('success', 'News item updated successfully.');
    }

    public function destroy(News $news)
    {
        Storage::disk('public')->delete($news->image);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News item deleted successfully.');
    }

    public function storeComment(Request $request, News $news)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $news->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('news.show', $news->id)->with('success', 'Comment added successfully.');
    }

    public function like(News $news)
    {
        $news->increment('likes'); 
        return back()->with('success', 'You liked this post!');
    }

    public function dislike(News $news)
    {
        $news->increment('dislikes');
        return back()->with('success', 'You disliked this post!');
    }

    public function react(Request $request, News $news)
    {
        $request->validate([
            'type' => 'required|in:like,dislike',
        ]);

        $existingReaction = Reaction::where('news_id', $news->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReaction) {
            if ($existingReaction->type === $request->type) {
                $existingReaction->delete();
            } else {
                $existingReaction->update(['type' => $request->type]);
            }
        } else {
            Reaction::create([
                'news_id' => $news->id,
                'user_id' => auth()->id(),
                'type' => $request->type,
            ]);
        }

        return redirect()->route('news.index')->with('success', 'Reaction added successfully.');
    }

}
