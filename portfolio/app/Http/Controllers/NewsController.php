<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('news.show', compact('news'));
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
}
