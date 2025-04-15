<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';
        $user = $request->user();

        return view('profile.edit', compact('user', 'layout'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated')->with('success', 'プロフィールが更新されました！')->with('message_type', 'alert-success');
    }

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

        return Redirect::to('/')->with('success', 'アカウントが削除されました。ご利用ありがとうございました。')->with('message_type', 'alert-info');
    }
}
