<?php


use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # 2 usuarios
        $this->call(UsersTableSeeder::class);

        # 6 categorias
       factory(App\Category::class, 6)->create();

        # 6 herramientas
       factory(\App\Tool::class, 5)->create();


    }
    
}
