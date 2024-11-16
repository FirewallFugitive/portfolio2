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


class DashboardController extends Controller
{
    /**
     * Search for users.
     */
    public function searchUsers(Request $request): View
    {
        $users = User::where('name', 'like', '%' . $request->input('search') . '%')
            ->get();

        return view('search', [
            'users' => $users,
        ]);
    }

}