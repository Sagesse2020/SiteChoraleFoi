<?php

namespace App\Http\Controllers;

use App\Models\Groupe_vocal;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
     // Dans un contrôleur ou une autre partie de votre application
  public function create() // sera appelé dans la route web.php
    {
        // Assurez-vous que la variable est correctement définie ici
        return view('groupes_vocaux.create');
    }
  protected $table = 'groupes_vocaux';
 public function store(Request $request) // sera appelé dans la route web.php
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Logique pour stocker les données du formulaire dans la base de données
        // Exemple simple :
         Groupe_vocal::create([
        'nom' => $request->nom,
        'description' => $request->description,
        ]);
        // Redirection ou message de succès
        return redirect()->route('groupes_vocaux.store')->with('success', ' Groupe vocal enregistrées avec succès.');
    }

 public function index()
    {
         // Récupérer toutes les groupes vocales depuis la base de données
        $groupes_vocaux = Groupe_vocal::all(); // Utiliser Groupe_vocal::paginate(10) pour la pagination

        // Retourner la vue avec les groupes vocaux
        return view('groupes_vocaux.index', compact('groupes_vocaux'));
    }

    public function rechercher(Request $request)
    {
        // Récupérer toutes les licences, ou appliquer un filtre si la recherche est présente
        $groupes_vocaux = groupe_vocal::query();
        // Si la recherche est remplie, filtrer les Licences
        if ($request->has('search') && !empty($request->search)) {
             $groupes_vocaux =  $groupes_vocaux->where('libelle', 'like', '%' . $request->search . '%');
        }
        // Récupérer les résultats de la recherche avec pagination (10 clients par page)
        $type_clients =  $groupes_vocaux->paginate(10);

        // Passer les résultats à la vue
        return view('typeClient.rechercher', compact('type_clients'));
    }
}
