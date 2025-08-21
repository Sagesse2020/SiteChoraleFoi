<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    use HasFactory;

     protected $table = 'galeries'; // table documents protegé dans son modèle Groupe_vocal
       protected $fillable = ['titre','evenement_id']; // protège la colonne titre et plus  si tu as d'autres colonnes, ajoute-les ici
        public function evenement()
    {
        return $this->belongsTo(evenement::class, 'evenement_id');
              // Passez les données à la vue
    }
}

