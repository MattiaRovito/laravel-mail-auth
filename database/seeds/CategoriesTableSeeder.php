<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    
    public function run()
    {
        // Popoliamo le categorie creando un array, quindi creiamo un model e lo includiamo
        $categories = ['Html', 'CSS', 'JavaScript', 'Php','Vue Cli'];

        // creo un'istanza del model con il foreach

        foreach ($categories as $category) {
            $newCategory = new Category();
            // inserisco i campi e includo, con l'use, la classe Str;
            $newCategory->name = $category;
            $newCategory->slug = Str::slug($category, '-');

            // salvo i dati, quindi effettuo il db:seed del file per importare i dati nel DB in phpMyAdmin.

            $newCategory->save();

            // Successivamente effettuo una migration 
            // php artisan make:migration update_posts_table --table=posts
            // Così facendo si fa capire che deve andare a prendere la tabella posts.
        }
    }
}
