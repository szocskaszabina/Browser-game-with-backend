@extends('layouts.app')
@section('content')
<h1>Profile</h1>

<div class="container d-flex justify-content-center">
<div class=" grey-font card">
<h2 class="card-header">{{$user->username}}</h2>
<div class="card-body"><img style="width: 100%; max-width: 500px min-width: 400px" src="/game-app/public/storage/avatar/{{$user->avatar}}"><br><br>
<p><strong>Score: {{$user->score}}</strong></p>
</div>
</div>
</div>

@endsection