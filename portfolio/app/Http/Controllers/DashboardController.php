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


class DashboardController extends Controller
{
    // search users
    public function searchUsers(Request $request): View
    {
        $users = User::where('name', 'like', '%' . $request->input('search') . '%')
            ->get();

        return view('search', [
            'users' => $users,
        ]);
    }

    public function index()
    {
        $news = News::orderBy('publication_date', 'desc')->take(5)->get();
        return view('dashboard', compact('news'));
    }

}