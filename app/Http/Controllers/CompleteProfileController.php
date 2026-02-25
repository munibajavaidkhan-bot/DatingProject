<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompleteProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.complete', compact('user'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'gender' => ['nullable', Rule::in(['Male','Female','Other'])],
            'dob' => ['nullable','date','before:today'],
            'location' => ['nullable','string','max:255'],
            'bio' => ['nullable','string','max:2000'],
            'profile_picture' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        // Handle image upload
        if ($request->hasFile('profile_picture')) {
            // delete old if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $user->fill($data);
        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully!');
    }
}
