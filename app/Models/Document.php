<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

     protected $table = 'documents'; // table documents protegé dans son modèle Groupe_vocal
       protected $fillable = ['titre','fichier','type','user_id']; // protège la colonne titre et plus  si tu as d'autres colonnes, ajoute-les ici
         public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
              // Passez les données à la vue
    }
}
