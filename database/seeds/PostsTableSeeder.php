<?php

use Illuminate\Database\Seeder;
// Utilizzare l'Str
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            // creare l'istanza
            $newPost = new Post();


            // generare i dati
            $newPost->title = 'Questo è il Post numero ' . ($i + 1);
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla ea numquam sunt facilis atque ducimus mollitia velit, nesciunt autem voluptas unde officia ab distinctio deleniti sit qui, alias sint veniam?';
            

            // salvare i dati
            $newPost->save();


            // dopo aver fatto tutto questo, fare 
            // php artisan db:seed --class=PostsTableSeeder
        }
    }
}
