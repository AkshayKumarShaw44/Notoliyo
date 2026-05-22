<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login authentication.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Log activity
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'login',
                'description' => 'User logged in',
            ]);

            return redirect()->intended('/dashboard')
                ->with('success', 'Welcome back, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $avatarColors = [
            '#EF4444', // red-500
            '#3B82F6', // blue-500
            '#10B981', // emerald-500
            '#F59E0B', // amber-500
            '#8B5CF6', // violet-500
            '#EC4899', // pink-500
            '#06B6D4', // cyan-500
            '#14B8A6', // teal-500
            '#6366F1', // indigo-500
        ];
        $randomColor = $avatarColors[array_rand($avatarColors)];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar_color' => $randomColor,
        ]);

        Auth::login($user);

        // Log activity
        Activity::create([
            'user_id' => $user->id,
            'action' => 'register',
            'description' => 'User registered and logged in',
        ]);

        return redirect('/dashboard')
            ->with('success', 'Account created successfully! Welcome to Notoliyo.');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'logout',
                'description' => 'User logged out',
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logged out successfully.');
    }

    /**
     * Show the user profile page.
     */
    public function showProfile(): View
    {
        $user = Auth::user();
        $activities = Activity::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('profile', compact('user', 'activities'));
    }

    /**
     * Update user profile settings.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'avatar_color' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar_color = $request->avatar_color;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Activity::create([
            'user_id' => $user->id,
            'action' => 'profile_updated',
            'description' => 'Updated profile details',
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}
