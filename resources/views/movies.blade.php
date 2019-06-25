@extends('layouts.app')
@section('content')
<h1>My movies ( {{(count($movies))}} )</h1>
    @if (count($movies) === 0)
        No saved movie found!
    @endif
    <div class="grid-container">
    @foreach ($movies as $movie)
        
            <div class="grid-item grey-font card movie-card">
                <h3>{{$movie->title}}</h3>
                <img class="img-fluid" src="{{$movie->poster}}">
                <p>{{$movie->overview}}</p>
                @if(!Auth::guest())
                    <form method="POST" action="{{route('delete-movie', ['user_id' => $movie->user_id])}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="movie_id" value="{{$movie->id}}"><br>
                    <input class="btn btn-danger" type="submit" value="Delete from list">
                    </form>
                @endif
            </div>
       
    @endforeach
    </div>
@endsection