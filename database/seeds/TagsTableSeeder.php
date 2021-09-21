<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Si crea un array e la si popola
        $tags = ['Front End', 'Back End', 'Laravel', 'Ionic','Java'];


        // Creo un'instanza con il foreach
        foreach ($tags as $tag) {
            $newTag = new Tag();

            // Inserisco i campi
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, '-');

            // Salvo i dati
            $newTag->save();
        }

        
    }
}
