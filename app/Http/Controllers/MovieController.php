<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\User;
use DB;

class MovieController extends Controller
{

//Save movie with current user id using the form in welcome.blade, and custom_script.js

    public function store(Request $request, string $id) {
        if(auth()->user()->id == $id){
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->overview = $request->input('overview');
        $movie->poster = $request->input('poster');
        $movie->user_id = $id;
        $movie->save();
        return redirect('/');
        } 
            return redirect()->back();
    }

//Show the list of movies of the current user    

    public function show (string $id) {
        if(auth()->user()->id == $id){
            
            $user = User::find($id);
            $movies = $user->movies()->orderBy('id', 'desc')->paginate(100);
            return view('movies')->with('movies', $movies);

            } 
            return redirect()->back();

    }

//Delete movie form the current user's movie list

    public function destroy (Request $req, string $id) {
        $movie_id = $req->input('movie_id');
        $movie = Movie::find($movie_id);

        if(auth()->user()->id == $id){
            
            $movie->delete();
            return redirect()->back();

        } 
            return redirect()->back();

    }
}
