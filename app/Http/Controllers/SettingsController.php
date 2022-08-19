<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return Inertia::render('Settings/Index', [
            'user' => $user
        ]);
    }

    public function passwordUpdate(Request $request)
    {
        // validate request
        $validation = Validator::make($request->all(), [
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
            ],
        ]);

        if ($validation->fails()) {
            request()->session()->flash('error', $validation->errors()->first());
            return Redirect::route('settings');
        }

        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        request()->session()->flash('success', 'Password updated.');
        return Redirect::route('settings');
    }
}
