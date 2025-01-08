<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClothingItem;

class OutfitController extends Controller
{
    public function share($id)
    {
        $outfit = \App\Models\Outfit::find($id);

        if (!$outfit || $outfit->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to share this outfit.');
        }

        $outfit->isPublic = true;
        $outfit->save();

        return redirect()->back()->with('success', 'Outfit shared successfully!');
    }



    public function index()
    {
        $outfits = \App\Models\Outfit::where('user_id', auth()->id())->get();
        $clothingItems = \App\Models\ClothingItem::where('user_id', auth()->id())->get();
    
        return view('outfits', compact('outfits', 'clothingItems'));
    }    

    public function generate()
    {
        $userId = auth()->id();

        $top = \App\Models\ClothingItem::where('user_id', $userId)->where('type', 'Top')->inRandomOrder()->first();
        $bottom = \App\Models\ClothingItem::where('user_id', $userId)->where('type', 'Bottom')->inRandomOrder()->first();
        $shoes = \App\Models\ClothingItem::where('user_id', $userId)->where('type', 'Shoes')->inRandomOrder()->first();
        $hat = \App\Models\ClothingItem::where('user_id', $userId)->where('type', 'Hat')->inRandomOrder()->first();

        if (!$top || !$bottom || !$shoes || !$hat) {
            \Log::info('Not enough items to generate an outfit');
            return redirect()->back()->with('error', 'Not enough clothing items to generate an outfit!');
        }

        $outfitName = 'Outfit ' . now()->format('Y-m-d H:i:s');
        \Log::info('All items found, generating outfit', [
            'top' => $top->id,
            'bottom' => $bottom->id,
            'shoes' => $shoes->id,
            'hat' => $hat->id,
        ]);

        $outfit = \App\Models\Outfit::create([
            'user_id' => $userId,
            'name' => $outfitName,
            'clothing_item_ids' => json_encode([$top->id, $bottom->id, $shoes->id, $hat->id]),
        ]);

        \Log::info('Outfit saved', ['outfit' => $outfit]);

        return redirect()->back()->with('success', 'Outfit generated successfully!');
    }

    public function destroy($id)
    {
        $outfit = \App\Models\Outfit::find($id);

        if (!$outfit || $outfit->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this outfit.');
        }

        $outfit->delete();

        return redirect()->back()->with('success', 'Outfit deleted successfully!');
    }



}
