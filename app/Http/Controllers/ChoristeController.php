<?php

namespace App\Http\Controllers;

use App\Models\Choriste;
use App\Models\Groupe_vocal;
use Illuminate\Http\Request;

class ChoristeController extends Controller
{
     public function create()
    {
        $choristes = Choriste::all();
        $groupes_vocaux = Groupe_vocal::all();
        return view('choristes.create', compact('choristes','groupes_vocaux'));
    }

 public function store(Request $request) // sera appelé dans la route web.php
    {
        // Logique pour stocker les données du formulaire dans la base de données
          // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:choristes,email',
            'groupe_id' => 'required|exists:groupes_vocaux,id',
        ]);

        // Création du client
        Choriste::create([
       'nom' => $request->nom,
        'telephone' => $request->telephone,
        'email' => $request->email,
        'groupe_id' => $request->groupe_id,
        ]);
        // Redirection ou message de succès
        return redirect()->route('choristes.create')->with('success', 'Choriste ajouté avec succès.');
    }

    public function show($id)
    {
        $choristes = Choriste::findOrFail($id);
        return view('choristes.show', compact('choristes'));
    }

     public function index()
    {  // Récupérer toutes les choristes depuis la base de données
        $choristes = Choriste::all(); // Utiliser Choriste::paginate(10) pour la pagination

        // Retourner la vue avec les choristes
        return view('choristes.index', compact('choristes'));
    }

     /**
     * Afficher la page d'accueil avec la fonctionnalité de recherche.
     */
    public function rechercher(Request $request)
    {
        // Récupérer tous les clients, ou appliquer un filtre si la recherche est présente
        $choristes = Choriste::query();

        // Si la recherche est remplie, filtrer les clients
        if ($request->has('search') && !empty($request->search)) {
            $choristes = $choristes->where('nom', 'like', '%' . $request->search . '%')
                               ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Récupérer les résultats de la recherche avec pagination (10 clients par page)
      $choristes =$choristes->paginate(10);

        // Passer les résultats à la vue
        return view('choristes.rechercher', compact('choristes'));
    }

     // Méthode pour afficher le formulaire de modification
    public function edit($id)
    {
        $choristes = Choriste::findOrFail($id);
        return view('choristes.edit', compact('choristes'));
    }

    // Méthode pour modifier un client
    public function update(Request $request, $id)
    {
        $choristes = Choriste::findOrFail($id);
        $choristes->update($request->all());
        return redirect()->route('choristes.index');
    }

    // Méthode pour copier un client
    public function copy($id)
    {
        $choristes = Choriste::findOrFail($id);

        // Crée une copie du client
        $newClient = $choristes->replicate();
        $newClient->save();

        return redirect()->route('choristes.index')->with('success', 'Choriste copié avec succès');
    }

    // Méthode pour coller un client
    public function paste($id)
    {
        // Votre logique pour coller un client (par exemple, une duplication ou un autre comportement)
        $choristes = Choriste::findOrFail($id);
        $newChoriste = $choristes->replicate();
        $newChoriste->save();

        return redirect()->route('choristes.index')->with('success', 'Choriste collé avec succès');
    }
}
