<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_vocal extends Model
{
    use HasFactory;

      protected $table = 'groupes_vocaux'; // table groupes_vocaux protegé dans son modèle Groupe_vocal
       protected $fillable = ['nom','description']; // protège la colonne nom et plus  si tu as d'autres colonnes, ajoute-les ici
    public function choristes()
    {
        return $this->hasMany(Choriste::class, 'choriste_id');
              // Passez les données à la vue
    }

}
