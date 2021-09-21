<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

// Usare il Model
use App\Category;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        // chi deve visualizzare i prodotti?

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); 
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validazione dei dati
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories_id',
            // ovvero category_id deve essere messo a null o deve esistere e preso dalla categoria di appartenenza
            'image' => 'nullable|image'
            // 'image' perché nell’input abbiamo scritto name='image'
            // 'nullable|image' -> nullable così non siamo obbligati ad inserire l'immagine 
        ]);


        // prendere i dati
        $data = $request->all();

        // prova
        // dd($data);


        // creare la nuova istanza con i dati ottenuti dalla request
        $new_post = new Post();

        $slug = Str::slug($data['title'], '-'); 



        // se c'è un duplicato

        $slug_base = $slug;

        $slug_presente =  Post::where('slug', $slug)->first();

        $contatore = 1;

        while($slug_presente){
            $slug = $slug_base . '-' . $contatore;

            $slug_presente =  Post::where('slug', $slug)->first();

            $contatore++;
        }

        // end se c'è un duplicato



        $new_post->slug = $slug;

        // Se nel nostro array c'è l'immagine, allora puoi salvarla
        if(array_key_exists('image', $data)){
            //salviamo l’immagine e recuperiamo il path (il percorso).
            $cover_path= Storage::put('covers', $data['image']);
            // ora bisogna assegnare alla colonna cover tutto il path. quindi salviamo nella Colonna della tabella posts l'immagine con il suo percorso
            $data['cover'] = $cover_path;
        };
        
        
        $new_post->fill($data);


      
            




        // salvare i dati
        $new_post->save();


        // inserisco l'attach()
        // $new_post->tags()->attach($data['tags']);

        // non basta, inserisco l'attach() con l'errore se non si dovesse spuntare niente

        // //! isset — Determine if a variable is declared and is different than null
        // if(isset($data['tags'])){
        //     $new_post->tags()->attach($data['tags']);
        // };

        if(array_key_exists('tags',$data)){
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    //! Collegamento show con slug (utilizzato nel front-office)
    //* al posto di $slug si può passare qualsiasi cosa, è sempre un segnaposto
    public function show($slug)
    {

        //* vado a selezionare il primo elemento
        $post = Post::where('slug', $slug)->first();


        $tags = Tag::all();

        return view('admin.posts.show', compact('post', 'tags'));
    }


    //! Collegamento show con id
    // public function show(Post $post)
    // {
    //     return view('admin.posts.show', compact('post'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post)
    {


        // validazione dei dati
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id'
            // ovvero category_id deve essere messo a null o deve esistere e preso dalla categoria di appartenenza
        ]);

        




        // prendere tutti i dati
        $data = $request->all();


        // dd($data);

        // Se è stato modificato aggiungi questo. Permette di aggiungere un -numero se è già esistente il titolo modificato. 
        if($data['title'] != $post->title){

            $slug = Str::slug($data['title'], '-'); 

            $slug_base = $slug;

            $slug_presente = Post::where('slug',  $slug)->first();

            $contatore = 1;
            while($slug_presente){
                // aggiungiamo al post di prima un -contatore
                $slug = $slug_base . '-' . $contatore++;
                // se lo slug è uguale ad uno già presente allora segue il procedimento sotto

                // controlliamo nuovamente se il post esiste ancora
                $slug_presente = Post::where('slug',  $slug)->first();              
            }

            // in ogni caso, sia se è entrato nel ciclo sia no, farà questo

            $data['slug'] = $slug;
        }   


       
        // vado a modificarli
        $post->update($data);
      


        // inserisco il sync()
        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }



        // fare il return
        return redirect()->route('admin.posts.index')->with('updated', 'Il post numero ' . $post->id . ' è stato modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
            $post->delete();

            // effettuo il detach();
            $post->tags()->detach();

            return redirect()->route('admin.posts.index')->with('deleted', 'Il post numero ' . $post->id . ' è stato eliminato con successo');
    }
}
