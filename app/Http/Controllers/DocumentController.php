<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create() // sera appelé dans la route web.php
    {
         $users = User::all();
         $documents = Document::all();
        // Assurez-vous que la variable est correctement définie ici
        return view('documents.create', compact('users','documents'));
    }
  protected $table = 'documents';
 public function store(Request $request) // sera appelé dans la route web.php
    {
        // Logique pour stocker les données du formulaire dans la base de données
        // Exemple simple :
          $request->validate([
            'titre' => 'required|string|max:255',
            'fichier' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);
       Document::create([
        'titre' => $request->titre,
        'fichier' => $request->fichier,
        'type' => $request->type,
        'user_id' => $request->user_id,
        ]);
        // Redirection ou message de succès
        return redirect()->route('documents.store')->with('success', 'Données enregistrées avec succès.');
    }

 public function index()
    {
         // Récupérer toutes les fromules abonnements depuis la base de données
        $documents = Document::all(); // Utiliser Groupe_vocal::paginate(10) pour la pagination

        // Retourner la vue avec les groupes vocaux
        return view('documents.index', compact('documents'));
    }

    public function rechercher(Request $request)
    {

        $documents = Document::query();
        if ($request->has('search') && !empty($request->search)) {
              $documents  =  $documents->where('libelle', 'like', '%' . $request->search . '%');
        }
        $documents = $documents ->paginate(10);
        return view('documents .rechercher', compact(' documents '));
    }
}
