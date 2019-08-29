<?php


$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// Categorias
$factory->define(App\Category::class, function (Faker\Generator $faker) {    
    return [
        'nombre' => $faker->unique()->randomElement(['Martillo', 'Alicate','destornillador','Pulidora','Cerrucho','Pala']),
    ];
});

// tools
$factory->define(App\Tool::class, function (Faker\Generator $faker) {    
    return [
        'nombre' => $faker->unique()->randomElement(['Martillo Madera', 'Martillo Madera','destornillador estrella','alicate pequeño','Cerrucho grande','Pala metal']),
        'imagen' => NULL,
        'descripcion' => $faker->text,
        'cantidad_disponible' => $faker->randomDigit(2,9),
        'category_id' => \App\Category::inRandomOrder()->first()
    ];
});

 # 6 herramientass
//  $tools = factory(\App\Tool::class, 6)->create([
//     'Category_id' => $this->getRandomCategoryId()
// ]);


// private function getRandomCategoryId() {
// $category = \App\Category::inRandomOrder()->first();
// return $category->id;
//                                }


