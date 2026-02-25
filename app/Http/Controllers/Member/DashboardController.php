<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Request $request)
{
    $user = $request->user();

    // 🔒 Role authorization
    if (!$user->isUser()) {
        abort(403, 'Unauthorized Access');
    }

    // 🔄 Profile completion redirect
    if (empty($user->gender) || empty($user->dob) || empty($user->profile_picture) || empty($user->location)) {
        return redirect()->route('profile.complete')->with('info', 'Please complete your profile to get better matches.');
    }

    return view('user.dashboard');
}

}
