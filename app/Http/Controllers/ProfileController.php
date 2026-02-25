<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * -------------------------------
     *  1. EDIT OWN PROFILE (BREEZE)
     * -------------------------------
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    /**
     * -------------------------------
     *  2. EDIT PROFILE BY USER ID
     * -------------------------------
     */
    public function editById($id): View
    {
        $user = User::findOrFail($id);

        // Return the new update view
        return view('profile.updateuserprofile', [
            'user' => $user
        ]);
    }

    /**
     * -------------------------------
     *  3. UPDATE OWN PROFILE (BREEZE)
     * -------------------------------
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('user.dashboard')->with('status', 'profile-updated');
    }

    /**
     * -------------------------------------
     *  4. UPDATE PROFILE BY USER ID (ADMIN)
     * -------------------------------------
     */
    public function updateById(Request $request, $id) // Changed to regular Request
    {
        $user = User::findOrFail($id);

        // Validate the request data
        $validated = $request->validate([
            'gender' => 'nullable|string|in:Male,Female,Other',
            'dob' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Fill the validated fields
        $user->fill($validated);

        // Handle profile picture if uploaded
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // Remove the duplicate fill() call and the dd() statement
        // $user->fill($request->except('profile_picture')); // REMOVE THIS LINE
        // dd($user->getAttributes()); // REMOVE THIS LINE

        $user->save();

        return redirect()->route('user.dashboard')->with('status', 'profile-updated');
    }

    /**
     * -------------------------------
     *  5. DELETE ACCOUNT (BREEZE)
     * -------------------------------
     */
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

    /**
     * Serve a profile photo from the storage public disk.
     */
    public function photo($filename)
    {
        $path = 'profile_pictures/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $contents = Storage::disk('public')->get($path);
        $mime = Storage::disk('public')->mimeType($path) ?? 'image/jpeg';

        return response($contents, 200)->header('Content-Type', $mime);
    }
}