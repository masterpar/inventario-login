<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'camilo',
            'email' => 'camilo@gmail.com',
            'tipo' => 'Admin',
            'password' => bcrypt('123456'),
            'cc' => '112155555',
            'telefono' => '3134640207',
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'name' => 'cristian',
            'email' => 'cristian@gmail.com',
            'tipo' => 'Empleado',
            'password' => bcrypt('123456'),
            'cc' => '5641561564185',
            'telefono' => '3134640207',
        ]);


    }
}
