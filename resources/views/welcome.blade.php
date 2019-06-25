@extends('layouts.app')
@section('content')

<div class="main">
  <h1>Welcome {{Auth::user()->username}}!</h1>
  <p>This is a simple Hangman game with titles of movies released from year 2017. 
  Note that it can contain numbers and special characters (for example: $, &) as well.
  You should type only one character at a time, otherwise it will not work!
  </p>
  <button id="startButton" class="btn btn-light">Start New Game</button><br>
  <div id="container" class="d-flex flex-wrap align-items-center justify-content-center"></div>
  <hr>
</div>

<div class="container-fluid">
<div class=" row content">
  <div id="hangman" class="col-md-4 col-12 order-2 order-md-1">
    <img src="pics/bg.png" alt="hangman" id="hanging" class="img-fluid">
  </div>

  <div class="playground col-md-3 col-12 order-1 order-md-2 d-flex flex-column justify-content-center">
      <label for="guess">Type in your character:</label>
      <input type="text" id="guess" class="input-group-text"><br>
      <button id="guessButton" class="btn btn-light">Guess</button><br>
      <div id="mistakes">Wrong letters: </div><br>
  </div>

  <div class="solution col-md-5 col-12 order-3">
      <div id="solution"></div>
      <div id=details></div><br>

@if(!Auth::guest())
  <form id="saveMovieForm" method="POST" action="{{route('save-movie', ['user_id' => Auth::user()->id])}}">
  @csrf
      <input id="title" type="hidden" value="" name="title">
      <input id="overview" type="hidden" value="" name="overview">
      <input id="poster" type="hidden" value="" name="poster">
      <button id="sendFormBtn" class="btn btn-light d-none">Save it to My Movies</button>
    </form>

    <form id="scoreUpdate" method="POST" action="">
  @csrf
      <input id="score" type="hidden" value="{{Auth::user()->id}}" name="score">
      
    </form>
@endif

    </div>
</div>
</div>

<audio src="sounds/Jump-SoundBible.com-1007297584.mp3" id="correct-sound"></audio>
<audio src="sounds/Strong_Punch-Mike_Koenig-574430706.mp3" id="hanging-sound"></audio>
<audio src="sounds/Sad_Trombone-Joe_Lamb-665429450.mp3" id="losing-sound"></audio>
<audio src="sounds/Applause Light 2-SoundBible.com-356111200.mp3" id="applause"></audio>
<script src="{{ asset('js/custom_script.js') }}" defer></script>

@endsection