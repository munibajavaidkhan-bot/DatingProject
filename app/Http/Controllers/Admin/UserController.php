<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('profile')->latest();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $users = $query->paginate(15);

        $totals = [
            'all'       => User::count(),
            'active'    => User::where('status', 'active')->count(),
            'suspended' => User::where('status', 'suspended')->count(),
            'admin'     => User::where('role', 'admin')->count(),
            'author'    => User::where('role', 'author')->count(),
        ];

        return view('admin.users.index', compact('users', 'totals'));
    }

    public function show(int $id)
    {
        $user = User::with(['profile', 'quizAnswers', 'subscription'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit(int $id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role'   => ['required', 'in:admin,author,user'],
            'status' => ['required', 'in:active,suspended,pending'],
            'password' => ['nullable', 'min:8'],
        ]);

        $data = $request->only('name', 'email', 'role', 'status');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Update profile if fields provided
        if ($request->has('gender') || $request->has('city')) {
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                array_filter($request->only(['first_name', 'last_name', 'gender', 'city', 'country', 'bio']))
            );
        }

        return redirect()->route('admin.users.index')
            ->with('success', "User {$user->name} updated successfully.");
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->isAdmin() && User::where('role', 'admin')->count() === 1) {
            return back()->with('error', 'Cannot delete the last admin account.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function toggleStatus(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Cannot change your own status'], 422);
        }

        $user->status = $user->status === 'active' ? 'suspended' : 'active';
        $user->save();

        return response()->json([
            'success' => true,
            'status'  => $user->status,
            'message' => "User {$user->status}",
        ]);
    }

    // ── Profile Approval ──────────────────────────────────────

    public function pendingApprovals()
    {
        $profiles = Profile::where('is_complete', true)
            ->where('is_approved', false)
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('admin.users.pending-approvals', compact('profiles'));
    }

    public function approveProfile(int $profileId)
    {
        $profile = Profile::findOrFail($profileId);
        $profile->update(['is_approved' => true, 'rejection_reason' => null]);

        return back()->with('success', "Profile for {$profile->user->name} has been approved.");
    }

    public function rejectProfile(Request $request, int $profileId)
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $profile = Profile::findOrFail($profileId);
        $profile->update([
            'is_approved' => false,
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', "Profile for {$profile->user->name} has been rejected.");
    }
}