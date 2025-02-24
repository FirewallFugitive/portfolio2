<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    //Display the user's profile form.
     
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    //Update the user's profile information.
     
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    //Delete the user's account.

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    //Update the user's profile picture.
    
    public function updatePicture(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        $path = $request->file('picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
        $user->save();
        
        return Redirect::route('profile.edit')->with('status', 'profile-updated');

    }

    //Update the user's about me information.
    
    public function updateAboutMe(Request $request): RedirectResponse
    {
        $request->validate([
            'about_me' => 'required|string|max:3000',
        ]);

        $user = $request->user();
        $user->about_me = $request->input('about_me');
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'about-updated');
    }

}
