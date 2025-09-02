<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('pages.home');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
        
            // خزّن الصورة في disk 'public'
            $file->storeAs('images', $filename, 'public');
        
            // المسار الصحيح للعرض في Blade
            $user->profile_image = 'storage/images/' . $filename;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
