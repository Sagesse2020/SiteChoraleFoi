<?php
// database/seeders/RolesPermissionsSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Role, Permission, User};

class RolesPermissionsSeeder extends Seeder {
    public function run(): void {
        // Rôles
        $admin = Role::firstOrCreate(['name'=>'admin'], ['label'=>'Administrateur']);
     $user  = Role::firstOrCreate(['name'=>'user'],  ['label'=>'Utilisateur']);

// Permissions
$pManageUsers  = Permission::firstOrCreate(['name'=>'manage_users'],  ['label'=>'Gérer les utilisateurs']);
$pManageEvents = Permission::firstOrCreate(['name'=>'manage_events'], ['label'=>'Gérer les événements']);
$pViewReports  = Permission::firstOrCreate(['name'=>'view_reports'],  ['label'=>'Voir les rapports']);

// Liaison permissions -> admin
$admin->permissions()->sync([$pManageUsers->id, $pManageEvents->id, $pViewReports->id]);
    }

}
