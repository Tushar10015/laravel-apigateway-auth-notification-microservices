<?php

use Illuminate\Http\Request;
use App\Jobs\SendLoginEvent;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Authenticate user (pseudo-code)
    if (true) {
        SendLoginEvent::dispatch($validated['email']);
        return response()->json(['token' => 'fake-jwt-token']);
    }

    return response()->json(['error' => 'Invalid credentials'], 401);
});
