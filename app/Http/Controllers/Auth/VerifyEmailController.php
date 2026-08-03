<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectAfterVerification($request);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectAfterVerification($request);
    }

    private function redirectAfterVerification(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        if (!$user->profile?->is_complete) {
            return redirect()->route('profile.complete')
                ->with('success', 'Email verified! Please complete your profile.');
        }

        return redirect()->intended(route('member.dashboard'))
            ->with('success', 'Email verified successfully!');
    }
}
