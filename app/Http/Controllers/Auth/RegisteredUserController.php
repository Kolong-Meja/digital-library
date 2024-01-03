<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roleId = Role::select('id')->pluck('id')[1];

        return view('auth.register', compact('roleId'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $registerRequest): RedirectResponse
    {
        $validatedData = $registerRequest->validated();

        $user = User::create([
            'role_id' => $validatedData['role_id'],
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'email' => $validatedData['name'],
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
