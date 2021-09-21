@extends('layouts.app');

@section('content')

<div class="container">
    <div class="card">
        <h2 class="p-3">In dettaglio</h2>
        <div class="card-header">
            {{$post->title}}
        </div>
        <div class="card-body">
          <h5 class="card-title"> {{$post->title}}</h5>

          @if($post->cover)
           
          <img src="{{asset('storage/'.$post->cover)}}" alt="">

          @endif



          <p class="card-text"> {{$post->content}}</p>
        </div>

        <div class="p-3">
            @forelse($post->tags as $tag)
            <p class="btn btn-outline-success">{{$tag->name}}</p>
            @empty  
            <span class="alert alert-warning">
                Non ci sono tag assegnati
            </span>
            @endforelse
        </div>

        <div class="p-3">
            <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna indietro</a>
        </div>

    </div>
</div>




@endsection()