<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
        'remember' => 'nullable|boolean', // pour sécuriser le checkbox
    ]);

    // Récupération du "remember" depuis le formulaire
    $remember = $request->has('remember');

    // Tentative de connexion
    if (Auth::attempt($request->only('email', 'password'), $remember)) {
        $request->session()->regenerate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Redirection selon le rôle avec message de bienvenue
        return $user->hasRole('admin')
            ? redirect()->route('admin')->with('success', 'Bienvenue, ' . $user->name . ' !')
            : redirect()->route('home')->with('success', 'Bienvenue, ' . $user->name . ' !');
    }

    // Échec de connexion
    return back()->withErrors(['email' => 'Email ou mot de passe incorrect'])->withInput();
}

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Premier utilisateur = admin
        $role = User::count() === 0 ? 'admin' : 'user';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $role,
        ]);

        Auth::login($user);

        return $user->hasRole('admin')
            ? redirect()->route('admin')
            : redirect()->route('home');
    }


     public function createUser()
    {
        return view('users');
    }

     // Enregistre un nouvel utilisateur
   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:8',
        'role' => 'required|in:user,admin',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => $validated['role'],
    ]);

    Auth::login($user); // connecte le nouvel utilisateur

    return $user->role === 'admin'
        ? redirect()->route('admin')
        : redirect()->route('home');

        return redirect()->route('admin')->with('success', 'Utilisateur créé avec succès !');

}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
