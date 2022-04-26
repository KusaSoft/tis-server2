<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role();
        $role1->name = "docente";
        $role1->description = "Puede crear solicitudes de reserva";
        $role1->save();

        $role2 = new Role();
        $role2->name = "operador";
        $role2->description = "Revisa y contesta solicitudes de reserva";
        $role2->save();

        $role3 = new Role();
        $role3->name = "admin";
        $role3->description = "Crea roles, inserta datos nuevos";
        $role3->save();
    }
}
