<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Rules\ReCaptcha;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
     
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login_type' => ['required', 'string', 'in:email,phone'],
            'login' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    $loginType = $request->input('login_type');

                    // Check uniqueness based on login type
                    $user = User::where($loginType, $value)->first();
                    if ($user) {
                        $fail(__('The '.$attribute.' has already been taken.'));
                    }
                }
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       
        $userData = [
            'name' => $request->input('name'),
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role
            'is_guest' => false, // Default guest value
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ];
       

        if ($request->login_type === 'email') {
            $userData['email'] = $request->login;
            $userData['phone'] = null;
        } else {
            $userData['phone'] = $request->login;
            $userData['email'] = null;
        }
            
        try {
            // Create the user
            $user = User::create($userData);

            // Fire registered event
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Redirect to the intended route
            return redirect()->route('nationalvote.create');

        } catch (QueryException $e) {
            // Handle duplicate entry error
            if ($e->getCode() === '23000') {
                return back()->withErrors(['login' => __('The email or phone number has already been taken.')])
                             ->withInput();
            }

            // Handle other query exceptions
            return back()->withErrors(['error' => __('An error occurred. Please try again later.')])
                         ->withInput();
        }
    }
}
