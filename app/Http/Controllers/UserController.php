<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

     // Affiche le formulaire de création d'utilisateur
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
        ]);

          $role = $validated['role']; // ou $request->role selon ton contexte
         $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $role,
        ]);


        return redirect()->route('users')->with('success', 'Utilisateur créé avec succès !');
    }
    public function profile()
    {
        return view('profile');
    }


    public function profil()
    {
        return view('profil');
    }


    public function update(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Vérifier l'ancien mot de passe
    if (!Hash::check($request->input('old-password'), $user->password)) {
        return redirect()->back()->with('error', 'Ancien mot de passe incorrect.');
    }

    // Changer le mot de passe si nécessaire
    if ($request->input('new-password') && $request->input('new-password_confirmation')) {
        if ($request->input('new-password') === $request->input('new-password_confirmation')) {
            $user->password = bcrypt($request->input('new-password'));
        } else {
            return redirect()->back()->with('error', 'Les mots de passe ne coïncident pas.');
        }
    }

    // Mettre à jour la photo si un fichier est envoyé
    if ($request->hasFile('photo')) {
        if ($user->photo && Storage::exists('public/' . $user->photo)) {
            Storage::delete('public/' . $user->photo);
        }
        $path = $request->file('photo')->store('profile_photos', 'public');
        $user->photo = $path;
    }

    // Mettre à jour les autres champs
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    $user->save();

    return redirect()->route('profile')->with('status', 'Profil édité avec succès');
}

   public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();
        /** @var \App\Models\User $user */
        $user = User::find(Auth::user()->id);


        // Supprimer l'ancienne photo si elle existe
        if ($user->photo && Storage::exists('public/'.$user->photo)) {
            Storage::delete('public/'.$user->photo);
        }

        // Stocker la nouvelle photo
        $path = $request->file('photo')->store('avatars', 'public');
        $user->photo = $path;
        $user->save();

        return redirect()->back()->with('success', 'Photo mise à jour avec succès.');
    }

}
