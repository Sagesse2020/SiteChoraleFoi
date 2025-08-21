<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

     protected $table = 'publications'; // table documents protegé dans son modèle Groupe_vocal
       protected $fillable = ['titre','contenu','image','date_publication', 'user_id']; // protège la colonne titre et plus  si tu as d'autres colonnes, ajoute-les ici
}
