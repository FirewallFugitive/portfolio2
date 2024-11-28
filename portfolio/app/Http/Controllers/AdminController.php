<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function promote(User $user)
    {
        $user->update(['is_admin' => true]);
        return back()->with('status', 'User promoted to admin.');
    }

    public function demote(User $user)
    {
        $user->update(['is_admin' => false]);
        return back()->with('status', 'Admin rights removed.');
    }

    public function showCreateForm()
    {
        return view('create');
    }
    
    // create user
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'is_admin' => 'boolean',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin ?? false,
        ]);
    
        return redirect()->back()->with('status', 'User created successfully.');
    }
    

}
