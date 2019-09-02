<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        Role::truncate();

        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();

        foreach ((new Role)->defaultRoles() as $role) {
            Role::create(['name' => $role]);
        }

        Schema::enableForeignKeyConstraints();

    }
}
