@extends('layouts.app')
@section('content')
@if (count($ranking) === 0)
        No user found!
@endif
<div class="container">
<h1>Ranking</h1>
<h3>Users: {{count($ranking)}}</h3>
<table class="table table-hover table-light">
     <tr style="text-align: center; text-transform: uppercase">
    <th scope="col">#</th>
    <th scope="col">User</th>
    <th scope="col">Score</th>
    </tr>

    @foreach ($ranking as $record)
            
            @if(Auth::user()->id === $record->id)
            
                <tr scope="row" class="table-dark" style="text-align: center">
                <td>{{$loop->index + 1}}</td>
                <td><a href="{{route('profile', ['user_id' => $record->id])}}">{{$record->username}}</a></td>
                <td>{{$record->score}}</td>
                </tr>

            @else
                <tr scope="row" style="text-align: center">
                <td>{{$loop->index + 1}}</td>
                <td><a href="{{route('profile', ['user_id' => $record->id])}}">{{$record->username}}</a></td>
                <td>{{$record->score}}</td>
                </tr>

            @endif
        
        
    @endforeach
</table>
</div>
@endsection