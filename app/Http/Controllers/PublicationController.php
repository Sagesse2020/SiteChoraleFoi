<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    // Affichage des publications
    public function index()
    {
        $publications = Publication::orderBy('date_publication', 'desc')->get();
        return view('publications.index', compact('publications'));
    }

    // Affichage du formulaire de création
    public function create()
    {
        return view('publications.create');
    }

    // Enregistrement d'une nouvelle publication
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_publication' => 'required|date'
        ]);

       $imagePath = $request->hasFile('image')
    ? $request->file('image')->store('publications', 'public')
    : 'default.png'; // mettre un fichier image par défaut dans public/storage/publications


        Publication::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'image' => $imagePath,
            'date_publication' => $request->date_publication,
            'user_id' => auth()->id() // si tu veux lier à l'utilisateur connecté
        ]);

        return redirect()->route('publications.index')->with('success', 'Publication ajoutée avec succès !');
    }
      public function rechercher(Request $request)
    {

        $publications = Publication::query();
        if ($request->has('search') && !empty($request->search)) {
              $publications =  $publications->where('libelle', 'like', '%' . $request->search . '%');
        }
        $publications=  $publications->paginate(10);
        return view('publications.rechercher', compact('publications'));
    }

      // Affiche le formulaire d'édition
    public function edit(Publication $publicite)
    {
        return view('publications.edit', compact('publication'));
    }

    // Met à jour une publicité existante
    public function update(Request $request, Publication $publicite)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['titre','contenu']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('publications', 'public');
        }

        $publicite->update($data);

        return redirect()->route('publications.index')
                         ->with('success', 'Publication mise à jour avec succès.');
    }

    // Supprime une publicité
    public function destroy(Publication $publicite)
    {
        $publicite->delete();

        return redirect()->route('publications.index')
                         ->with('success', 'Publication supprimée avec succès.');
    }
}
