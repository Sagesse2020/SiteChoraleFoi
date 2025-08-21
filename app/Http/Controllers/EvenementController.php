<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EvenementController extends Controller
{

    public function create() // sera appelé dans la route web.php
    {
        $evenements = Evenement::all();
        // Assurez-vous que la variable est correctement définie ici
        return view('evenements.create',compact('evenements'));
    }
  protected $table = 'evenements';
public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'lieu' => 'required|string',
        'type' => 'required|string',
        'image' => 'required|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $validated['image'] = $imagePath;
    }

    Evenement::create($validated);

    return redirect()->route('evenements.index')->with('success', 'Événement enregistré avec succès !');
}

 public function index()
    {
         // Récupérer tous les événements (ordre date, par ex.)
        $evenements = Evenement::orderBy('date', 'desc')->get();
        // Récupère les événements avec pagination
        $evenements = Evenement::latest()->paginate(6);

        // Passer les événements à la vue
        return view('evenements.index', compact('evenements'));
    }

    public function evenement()
    {
         // Récupérer toutes les fromules abonnements depuis la base de données
        $evenements = Evenement::all(); // Utiliser Groupe_vocal::paginate(10) pour la pagination

        // Retourner la vue avec les groupes vocaux
        return view('evenements', compact('evenements'));
    }

    public function rechercher(Request $request)
    {

        $evenements = Evenement::query();
        if ($request->has('search') && !empty($request->search)) {
              $evenements  =  $evenements->where('libelle', 'like', '%' . $request->search . '%');
        }
        $evenements = $evenements ->paginate(10);
        return view('evenements.rechercher', compact('evenements'));
    }

    public function show($id)
{
    $evenement = Evenement::findOrFail($id); // récupère ou erreur 404

    return view('evenements.show', compact('evenement'));
}

public function showAlbums()
{
    $evenements = Evenement::with('galeries')->orderBy('date')->get();

    return view('albums.index', compact('evenements'));
}

 // Afficher la liste des événements à venir
    public function futur()
    {
        $evenements = Evenement::whereDate('date', '>=', now())
                        ->orderBy('date', 'asc')
                        ->get();

        return view('evenements.futur', compact('evenements'));
    }

    // Gérer l'inscription à un événement (exemple simple)
    public function inscription($id)
    {
        $evenement = Evenement::findOrFail($id);

        // Ici tu peux ajouter la logique d'inscription, ex:
        // enregistrer dans une table inscription, envoyer mail, etc.
        // Pour l'exemple on simule une confirmation :

        return redirect()->route('evenements.index')
            ->with('success', "Inscription confirmée pour l'événement : {$evenement->titre}");
    }
}
