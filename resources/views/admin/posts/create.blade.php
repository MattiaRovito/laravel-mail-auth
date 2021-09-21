@extends('layouts.app')

@section('content')

<div class="container">
      {{-- primo metodo per visualizzare tutti gli errori --}}
      {{-- @if($errors->any())
      @dd($errors) 
      <div class="alert alert-warning">
      
        <ul>
              @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
        </ul>
      </div>
      @endif --}}

       {{-- secondo metodo per visualizzare tutti gli errori. Si inserisce direttamente all'interno della classe dell'input title e content --}}



   


    <form action="{{route('admin.posts.store')}}" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="mb-3">
          <label for="titolo" class="form-label">Titolo</label>
          {{-- old title consente di immagazzinare il valore precedentente --}}
          <input type="text" class="form-control
          @error('title')
          is-invalid
          @enderror"
          id="titolo" name="title" value="{{old('title')}}">
          @error('title')
          <div class="alert alert-warning">{{$message}}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="categorie" class="form-label">Categorie</label>
       
          <select name="categories_id" id="categorie" class="form-control">
            <option value="">Seleziona una categoria</option>
            @foreach($categories as $category)

            <option value="{{$category->id}}"
              @if($category->id == old('categories_id') ) selected 
              @endif>{{$category->name}}</option>


            @endforeach
          </select>
        </div>

      

        <div class="mb-3">
            <label for="img" class="form-label">Immagine</label>
            <input type="file" id="img" name="image" class="form-control-label
            @error('image')
            is-invalid
            @enderror">

            @error('image')
              <div class="alert alert-danger">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
          <label for="descrizione" class="form-label">Descrizione</label>

          <textarea 
            name="content" id="descrizione" cols="30" rows="10" class="form-control
            @error('content')
            is-invalid
            @enderror">
            {{old('content')}}
          </textarea>
          @error('content')
          <div class="alert alert-warning">{{$message}}</div>
          @enderror
         
        </div>


        <div>
          <h3>Tag</h3>
          @foreach ($tags as $tag)
          <div class="form-check d-inline-block mx-1 my-2">

            {{-- inserisco un contatore dinamico nell'id e nel for (loop->iteration()). Se analizziamo nel browser questa sezione, si può vedere come i tag degli imput e delle label aumentano dinamicamente --}}

            <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag {{$loop->iteration}}" name="tags[]"
            @if(in_array($tag->id, old('tags', []))) 
            checked 
            @endif>

            {{-- nell'input ho inserito il name="tags[]". Questo perché non sempre si passerà un solo elemento, ma si potranno passare più elementi, quindi ci sarà bisogno di un array di elementi. --}}

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