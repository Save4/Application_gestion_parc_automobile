<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'marque-list',
            'marque-create',
            'marque-edit',
            'marque-delete',
            'modele-list',
            'modele-create',
            'modele-edit',
            'modele-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'vehicule-list',
            'vehicule-create',
            'vehicule-edit',
            'vehicule-delete',
            'departement-list',
            'departement-create',
            'departement-edit',
            'departement-delete',
            'chauffeur-list',
            'chauffeur-create',
            'chauffeur-edit',
            'chauffeur-delete',
            'mission-list',
            'mission-create',
            'mission-edit',
            'mission-delete',
            'carburant-list',
            'carburant-create',
            'carburant-edit',
            'carburant-delete',
            'fournisseur-list',
            'fournisseur-create',
            'fournisseur-edit',
            'fournisseur-delete',
            'document-list',
            'document-create',
            'document-edit',
            'document-delete',
            'piece-list',
            'piece-create',
            'piece-edit',
            'piece-delete',
            'reparation-list',
            'reparation-create',
            'reparation-edit',
            'reparation-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
