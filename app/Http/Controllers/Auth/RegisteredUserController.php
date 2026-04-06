<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,teacher'],
            'phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'language_level' => ['nullable', 'in:beginner,elementary,intermediate,upper_intermediate,advanced'],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'language_level' => $request->language_level ?? 'beginner',
            'bio' => $request->bio,
            'status' => $request->role === 'teacher' ? 'pending' : 'active',
            'points' => 0,
            'level' => 1,
            'current_streak' => 0,
            'longest_streak' => 0,
            'total_study_time' => 0,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard')->with('success', 'Welcome to TS Language Platform! Start your French learning journey.');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard')->with('warning', 'Your teacher account is pending approval. You will be notified once approved.');
        }

        return redirect()->route('dashboard');
    }
}
