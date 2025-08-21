<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    // Relation avec les permissions
  public function permissions()
{
    return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
}


    // Relation avec les utilisateurs
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
