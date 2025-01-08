<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use App\Models\Outfit;


class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $outfits = Outfit::where('isPublic', true)
            ->where('user_id', '!=', auth()->id())
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();

        if ($search) {
            $searchLower = strtolower($search);
    
            $outfits = $outfits->filter(function ($outfit) use ($searchLower) {
                if (str_contains(strtolower($outfit->user->name), $searchLower)) {
                    return true;
                }
    
                if (str_contains(strtolower($outfit->name), $searchLower)) {
                    return true;
                }

                foreach ($outfit->clothingItems as $item) {
                    if (str_contains(strtolower($item->color), $searchLower)) {
                        return true;
                    }
                }
    
                return false;
            });
        }
    
        return view('dashboard', compact('outfits', 'search'));
    }

    public function userProfile($id)
    {
        $user = User::findOrFail($id);
        $outfits = $user->outfits()->where('isPublic', true)->get();

        return view('profile/user-profile', compact('user', 'outfits'));
    }

}