<?php

namespace App\Http\Controllers;

use App\Models\Publicite;
use Illuminate\Http\Request;

class PubliciteController extends Controller
{

    // Affiche toutes les publicités
    public function index()
    {
        $publicites = Publicite::latest()->get();
        return view('publicites.index', compact('publicites'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('publicites.create');
    }

    // Enregistre une nouvelle publicité
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image' => 'nullable|image|max:2048' // image optionnelle
        ]);

        $data = $request->only(['titre','contenu']);

        // Gestion de l'image si elle est uploadée
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('publicites', 'public');
        }

        Publicite::create($data);

        return redirect()->route('publicites.index')
                         ->with('success', 'Publicité créée avec succès.');
    }

    public function rechercher(Request $request)
    {

        $publicites = Publicite::query();
        if ($request->has('search') && !empty($request->search)) {
              $publicites  =  $publicites->where('libelle', 'like', '%' . $request->search . '%');
        }
        $publicites =  $publicites->paginate(10);
        return view('publicites.rechercher', compact('publicites'));
    }

      // Affiche le formulaire d'édition
    public function edit(Publicite $publicite)
    {
        return view('publicites.edit', compact('publicite'));
    }

    // Met à jour une publicité existante
    public function update(Request $request, Publicite $publicite)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['titre','contenu']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('publicites', 'public');
        }

        $publicite->update($data);

        return redirect()->route('publicites.index')
                         ->with('success', 'Publicité mise à jour avec succès.');
    }

    // Supprime une publicité
    public function destroy(Publicite $publicite)
    {
        $publicite->delete();

        return redirect()->route('publicites.index')
                         ->with('success', 'Publicité supprimée avec succès.');
    }
}
