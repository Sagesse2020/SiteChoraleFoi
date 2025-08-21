<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use Illuminate\Http\Request;

class RechercheController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $resultats = Galerie::where('titre', 'like', '%' . $query . '%')
            ->orWhere('type', 'like', '%' . $query . '%')
            ->orWhere('url', 'like', '%' . $query . '%')
            ->get();

        return view('home', [ // ou 'welcome' ou 'admin' selon ta vue
            'galeries' => $resultats,
        ]);
    }

}
