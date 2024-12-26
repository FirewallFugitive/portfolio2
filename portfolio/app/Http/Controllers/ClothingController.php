<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClothingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|string',
            'color' => 'nullable|string',
        ]);

        $image = $request->file('image');
        $imageData = base64_encode(file_get_contents($image->getRealPath()));

        \App\Models\ClothingItem::create([
            'user_id' => auth()->id(),
            'image_data' => $imageData,
            'type' => $request->type,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('success', 'Clothing item uploaded successfully!');
    }

    public function index()
    {
        $clothingItems = \App\Models\ClothingItem::where('user_id', auth()->id())->get();

        return view('clothing', compact('clothingItems'));
    }
    public function destroy($id)
    {
        $clothingItem = \App\Models\ClothingItem::where('id', $id)->where('user_id', auth()->id())->first();

        if ($clothingItem) {
            $clothingItem->delete();
            return redirect()->back()->with('success', 'Clothing item deleted successfully!');
        }

        return redirect()->back()->with('error', 'Clothing item not found or unauthorized!');
    }


}
