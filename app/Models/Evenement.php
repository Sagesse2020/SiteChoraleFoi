<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $table = 'evenements'; // table documents protegé dans son modèle Groupe_vocal
       protected $fillable = ['titre', 'description', 'date', 'lieu', 'type', 'image'];

       public function galeries()
{
    return $this->hasMany(Galerie::class);
}

}
