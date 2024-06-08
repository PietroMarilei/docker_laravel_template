<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();
        //dd($users);
        return Inertia::render('UsersChatList', ['users'=>$users]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = $request->user()->load('doctor');
        // dd($user->doctor);
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'doctor' => $user->doctor ?? null,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());       
        // aggiorna per dottore
        if (!!$user->doctor) {
            $user->doctor->update([
                'specialization' => $request->input('specialization'),
                'meeting_link' => $request->input('meeting_link'),
            ]);
        } 

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }
    //🖼️ profile pic updater
    public function updateProfileImage(Request $request)
    {
        $this->validate($request, [
            'photo_url' => 'mimes:jpg,png,jpeg,webp|max:200000'
        ]);

        if (Storage::disk('public')->exists(auth()->user()->photo_url)) {
            Storage::disk('public')->delete(auth()->user()->photo_url);
        }

        $file = $request->file('photo_url');
        $path = $file->store('profiles', 'public');

        auth()->user()->update([
            'photo_url' => $path
        ]);

        return redirect()->route('profile.edit')->with([
            'message' => 'Image uploaded successfully',
            'class' => 'alert alert-success'
        ]);
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
