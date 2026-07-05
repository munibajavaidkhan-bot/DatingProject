<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user    = Auth::user()->load('profile');
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'first_name'    => ['nullable', 'string', 'max:100'],
            'last_name'     => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date', 'before:-18 years'],
            'gender'        => ['nullable', 'in:male,female,other'],
            'city'          => ['nullable', 'string', 'max:100'],
            'country'       => ['nullable', 'string', 'max:100'],
            'bio'           => ['nullable', 'string', 'max:1000'],
            'occupation'    => ['nullable', 'string', 'max:100'],
            'education'     => ['nullable', 'string', 'max:100'],
            'relationship_goal' => ['nullable', 'in:marriage,long_term,casual,friendship,not_sure'],
            'interests'     => ['nullable', 'array'],
            'height'        => ['nullable', 'integer', 'min:100', 'max:250'],
            'body_type'     => ['nullable', 'in:slim,athletic,average,curvy,heavy,prefer_not_to_say'],
            'religion'      => ['nullable', 'string', 'max:50'],
            'smoking'       => ['nullable', 'in:never,occasionally,regularly,prefer_not_to_say'],
            'drinking'      => ['nullable', 'in:never,occasionally,socially,regularly,prefer_not_to_say'],
            'has_children'  => ['nullable', 'in:yes,no,prefer_not_to_say'],
            'wants_children'=> ['nullable', 'in:yes,no,maybe,prefer_not_to_say'],
            'preferred_age_min'      => ['nullable', 'integer', 'min:18', 'max:99'],
            'preferred_age_max'      => ['nullable', 'integer', 'min:18', 'max:99'],
            'preferred_gender'       => ['nullable', 'in:male,female,other,any'],
            'preferred_distance_km'  => ['nullable', 'integer', 'min:10', 'max:10000'],
        ]);

        // Update user table
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Update or create profile
        $profileData = $request->only([
            'first_name', 'last_name', 'date_of_birth', 'gender',
            'city', 'country', 'bio', 'occupation', 'education',
            'relationship_goal', 'interests', 'height', 'body_type',
            'religion', 'smoking', 'drinking', 'has_children', 'wants_children',
            'preferred_age_min', 'preferred_age_max',
            'preferred_gender', 'preferred_distance_km',
        ]);

        // Check if profile is complete
        $requiredFields = ['first_name', 'date_of_birth', 'gender', 'city', 'bio'];
        $isComplete = true;
        foreach ($requiredFields as $field) {
            if (empty($profileData[$field] ?? $user->profile?->$field)) {
                $isComplete = false;
                break;
            }
        }
        $profileData['is_complete'] = $isComplete;

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $user = Auth::user();

        // Delete old photo
        if ($user->profile?->profile_picture) {
            Storage::disk('public')->delete($user->profile->profile_picture);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            ['profile_picture' => $path]
        );

        return back()->with('success', 'Profile photo updated!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password changed successfully!');
    }

    public function destroy(Request $request)
    {
        $request->validate(['password' => ['required']]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }

    public function show(int $id)
    {
        $profileUser = User::with('profile')->findOrFail($id);

        // Increment profile views
        if ($profileUser->id !== Auth::id()) {
            $profileUser->profile?->increment('profile_views');
        }

        return view('profile.updateuserprofile', compact('profileUser'));
    }
}