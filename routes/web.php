<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

// Redirect to Google
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')
        ->scopes([
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/calendar.readonly',
            'https://www.googleapis.com/auth/tasks.readonly',
            'https://www.googleapis.com/auth/gmail.readonly'
        ])
        ->redirect();
});

// Google callback
Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->stateless()->user();
    session(['google_token' => $user->token]);
    return redirect('/dashboard');
});

// Dashboard route
Route::get('/dashboard', function () {
    $token = session('google_token');

    $calendar = Http::withToken($token)
        ->get('https://www.googleapis.com/calendar/v3/calendars/primary/events')
        ->json();

    $tasks = Http::withToken($token)
        ->get('https://tasks.googleapis.com/tasks/v1/lists/@default/tasks')
        ->json();

    $emails = Http::withToken($token)
        ->get('https://gmail.googleapis.com/gmail/v1/users/me/messages?maxResults=5')
        ->json();

    return view('dashboard', compact('calendar', 'tasks', 'emails'));
});
