@extends('layouts.app')

@section('content')

<div class="container">
    {{-- @foreach ( $categories as $category )

    <p>{{$category->name}}</p>
    <p>{{$category->post->title}}</p>
        
    @endforeach --}}
</div>

<div class="container">
    @if(session('updated'))
        <div class="alert alert-success">
            {{session('updated')}}
        </div>
    @endif

    @if(session('deleted'))
        <div class="alert alert-danger">
            {{session('deleted')}}
        </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Categoria</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post )
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>
                        {{-- @dd($post->category) --}}
                        @if($post->category)
                        {{$post->category->name}}
                        @endif
                    </td>
                    <td>

                        {{-- Show con slug --}}
                        <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-primary">Show</a>


                        {{-- Show con id --}}
                        {{-- <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">Show</a> --}}
                        <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning">Edit</a>
                        {{-- la classe delete-post-form farà uscire un alert tramite JS --}}
                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="post" class="d-inline-block delete-post-form">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
         
         
        </tbody>
    </table>
</div>




@endsection