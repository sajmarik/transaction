<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

           'role-list', 'role-create', 'role-edit', 'role-delete',

           'user-list', 'user-create', 'user-edit', 'user-delete',

           'compte_bancaire-list', 'compte_bancaire-create', 'compte_bancaire-edit', 'compte_bancaire-delete',

           'banque-list', 'banque-create', 'banque-edit', 'banque-delete',

           'categorie-list', 'categorie-create', 'categorie-edit', 'categorie-delete',

           'echeance-list', 'echeance-create', 'echeance-edit', 'echeance-delete',

           'rapport-list', 'rapport-create', 'rapport-edit', 'rapport-delete',

           'rapprochement_bancaire-list', 'rapprochement_bancaire-create', 'rapprochement_bancaire-edit', 'rapprochement_bancaire-delete',

           'transfert-list', 'transfert-create', 'transfert-edit', 'transfert-delete',

           'transaction-list', 'transaction-create', 'transaction-edit', 'transaction-delete',

           'paiement_cheque-list', 'paiement_cheque-create', 'paiement_cheque-edit', 'paiement_cheque-delete',

           'paiement_virrement-list', 'paiement_virrement-create', 'paiement_virrement-edit', 'paiement_virrement-delete',

        ];

      

        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }
}
