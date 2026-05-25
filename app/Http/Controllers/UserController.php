<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function completeOnboarding(Request $request)
    {
        $user = $request->user();

        // Update the flag in the database
        $user->update([
            'needs_onboarding' => false,
        ]);

        return response()->json(['success' => true]);
    }
}
