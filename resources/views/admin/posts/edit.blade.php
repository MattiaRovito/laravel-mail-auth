@extends('layouts.app')

@section('content')


<div class="container">
    {{-- @if($errors->any())
        <div class="alert alert-warning">

              <ul>
                @foreach ($errors->all() as $error )

                <li>{{$error}}</li>


                @endforeach
              </ul>
         
        </div>
    @endif --}}



    <form action="{{route('admin.posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
          <label for="titolo" class="form-label">Titolo</label>
          <input type="text" class="form-control
          @error('title')
          is-invalid
          @enderror" 
          id="titolo" name="title" value="{{ old('title', $post->title)}}">
          @error('title')
          <div class="alert alert-warning">{{$message}}</div>
          @enderror
        </div>


        <div class="mb-3">
          {{-- inseriamo un errore (se è vuoto) --}}
          {{-- <p>
            @if($post->category)
            {{$post->category->name}}
            @endif
          </p> --}}
          <label for="categorie" class="form-label">Categorie</label>
          <select name="category_id" id="categorie" class="form-control">
            <option value="">Seleziona una categoria</option>
            @foreach ($categories as $category )
                <option value="{{$category->id}}"
                  @if($category->id == old('categories_id', $post->category_id)) 
                  selected 
                  @endif>{{$category->name}}</option>
            @endforeach
          </select>
          
        </div>


        {{-- Nell'edit se si va a modificare un post che contiene già un'immagine, allora me lo visualizza --}}
        <div class="mb-3">
          @if($post->cover)
            <img src="{{ asset('storage/' . $post->cover)}}" alt="" class="w-25">
          @endif
        </div>

        <div class="mb-3">
          <label for="img" class="form-label">Immagine</label>
          <input id="img" type="file" name="image" class="form-control-file 
          @error('image') 
          is-invalid 
          @enderror">
          @error('image')
               <div class="alert alert-danger">{{ $message }}</div>
          @enderror 

        </div>

        <div class="mb-3">
          <label for="descrizione" class="form-label">Descrizione</label>
         <textarea name="content" id="" cols="30" rows="10" class="form-control
          @error('content')
            is-invalid
          @enderror"
          id="descrizione">{{ old('content', $post->content)}}</textarea>
          @error('content')
          <div class="alert alert-warning">{{$message}}</div>
          @enderror
        </div>

        <div>
          <h3>Tag</h3>
          @foreach ($tags as $tag)
          <div class="form-check d-inline-block mx-1 my-2">

            

            <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag {{$loop->iteration}}" name="tags[]"

            @if(!$errors->any() && $post->tags->contains($tag->id))
            checked
            @elseif(in_array($tag->id, old('tags', [])))
            checked
            @endif>

           

            <label class="form-check-label" for="tag {{$loop->iteration}}">
              {{$tag->name}}
            </label>

          </div>
          @endforeach
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>









@endsection