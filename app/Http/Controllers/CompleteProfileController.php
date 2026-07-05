<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\UserContentProgress;
use App\Models\ContentWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompleteProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('profile');

        // If already complete, redirect to dashboard
        if ($user->profile?->is_complete) {
            return redirect()->route('member.dashboard');
        }

        return view('profile.complete', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'        => ['required', 'string', 'max:100'],
            'last_name'         => ['required', 'string', 'max:100'],
            'date_of_birth'     => ['required', 'date', 'before:-18 years'],
            'gender'            => ['required', 'in:male,female,other'],
            'city'              => ['required', 'string', 'max:100'],
            'country'           => ['required', 'string', 'max:100'],
            'bio'               => ['required', 'string', 'min:50', 'max:1000'],
            'relationship_goal' => ['required', 'in:marriage,long_term,casual,friendship,not_sure'],
            'interests'         => ['required', 'array', 'min:3'],
            'preferred_gender'  => ['required', 'in:male,female,other,any'],
            'preferred_age_min' => ['required', 'integer', 'min:18'],
            'preferred_age_max' => ['required', 'integer', 'min:18', 'max:99'],
            'profile_picture'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $user = Auth::user();
        $data = $request->only([
            'first_name', 'last_name', 'date_of_birth', 'gender',
            'city', 'country', 'bio', 'relationship_goal', 'interests',
            'preferred_gender', 'preferred_age_min', 'preferred_age_max',
            'occupation', 'education', 'religion',
        ]);

        $data['is_complete'] = true;

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')
                ->store('profile-photos', 'public');
        }

        Profile::updateOrCreate(['user_id' => $user->id], $data);

        // Unlock first 4 weeks of content automatically
        $firstFourWeeks = ContentWeek::where('week_number', '<=', 4)
            ->where('is_published', true)
            ->get();

        foreach ($firstFourWeeks as $week) {
            UserContentProgress::updateOrCreate(
                ['user_id' => $user->id, 'content_week_id' => $week->id],
                ['is_unlocked' => true, 'unlocked_at' => now()]
            );
        }

        return redirect()
            ->route('member.dashboard')
            ->with('success', 'Welcome to The Love Project! Your profile is now complete. 💕');
    }
}