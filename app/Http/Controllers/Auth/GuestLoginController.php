<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GuestLoginController extends Controller
{
    public function login()
    {
      
    if (Session::has('guest_logged_in')) {
        return redirect()->back()->withErrors(['error' => 'You have already logged in as a guest.']);
    }
    $guestUser = User::firstOrCreate(
        ['email' => 'guest@example.com'],
        ['name' => 'Guest User', 'password' => bcrypt('guestpassword')],
        ['g-recaptcha-response' => ['required', new ReCaptcha]]
      
    );

    Auth::login($guestUser);
    Session::put('guest_logged_in', true);
    return redirect()->route('dashboard');

    }
}