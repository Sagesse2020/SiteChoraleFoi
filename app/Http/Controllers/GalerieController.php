<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Galerie;
use Illuminate\Http\Request;

class GalerieController extends Controller
{
    public function create() // sera appelé dans la route web.php
    {
        $evenements = Evenement::all();
        $galeries = Galerie::all();
        // Assurez-vous que la variable est correctement définie ici
        return view('galeries.create', compact('galeries','evenements'));
    }
  protected $table = 'galeries';

    /**
     * Enregistrer une nouvelle image
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'evenement_id' => 'required|exists:evenements,id',
        ]);

        Galerie::create([
            'titre' => $request->titre,
            'evenement_id' => $request->evenement_id
        ]);

        return redirect()->route('galeries.index')->with('success', 'Image ajoutée avec succès');
    }

 /**
     * Liste des galeries
     */
    public function index()
    {
        // Charger l'événement lié à chaque image
        $galeries = Galerie::with('evenement')->latest()->get();

        return view('galeries.index', compact('galeries'));
    }

    public function rechercher(Request $request)
    {

        $galeries = Galerie::query();
        if ($request->has('search') && !empty($request->search)) {
              $galeries  =  $galeries->where('libelle', 'like', '%' . $request->search . '%');
        }
        $galeries =  $galeries->paginate(10);
        return view('galeries.rechercher', compact(' galeries'));
    }
}
