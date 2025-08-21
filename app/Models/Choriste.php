<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Choriste extends Model
{
    use HasFactory, Notifiable;

    public function groupe()
    {
        return $this->belongsTo(Groupe_vocal::class, 'groupe_id');
              // Passez les données à la vue
    }

       public function Presence()
    {
        return $this->hasMany(Presence::class);
    }

     protected $fillable = [
           'nom', 'telephone','email' ,'groupe_id'
             ];
}
