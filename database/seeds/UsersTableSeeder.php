<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        User::truncate();

        $superAdminRole = Role::where('name', 'super-admin')->first();

        $user = new User;
        $user->name = 'Neil Carlo Sucuangco';
        $user->email = 'succute@yahoo.com';
        $user->password = bcrypt('123321123');
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole($superAdminRole);

        Schema::enableForeignKeyConstraints();

    }
}
