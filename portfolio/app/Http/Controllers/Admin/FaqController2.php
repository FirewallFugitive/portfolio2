<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqCategory;

class FaqController2 extends Controller
{
    // Display a listing of FAQs
    public function index()
    {
        $categories = FaqCategory::with('faqs')->get();

        // Return the view with the categories data
        return view('admin.index', compact('categories'));
    }

    // Show the form for creating a new FAQ
    public function create()
    {
        $categories = FaqCategory::all();
        return view('admin.create', compact('categories'));
    }

    // Store a newly created FAQ in storage
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:faq_categories,id',
            'new_category' => 'nullable|string|max:255',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        // Handle the category
        $categoryId = $request->category_id;
        if ($request->filled('new_category')) {
            $category = FaqCategory::create(['name' => $request->new_category]);
            $categoryId = $category->id;
        }

        if (!$categoryId) {
            return back()->withErrors(['category_id' => 'Please select or create a category.']);
        }

        // Save the FAQ
        Faq::create([
            'category_id' => $categoryId,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ added successfully.');
    }

    // Show the form for editing the specified FAQ
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = FaqCategory::all();
        return view('admin.edit', compact('faq', 'categories'));
    }

    // Update the specified FAQ in storage
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    // Remove the specified FAQ from storage
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete(); 

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }


}
