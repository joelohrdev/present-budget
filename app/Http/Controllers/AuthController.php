<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class AuthController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'passcode' => 'required|string|min:4|max:4',
        ]);

        if ($request->passcode === config('app.passcode')) {
            session(['authenticated' => true]);

            return redirect()->route('index');
        }

        return back()->withErrors(['passcode' => 'Invalid passcode']);
    }
}
