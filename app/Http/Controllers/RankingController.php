<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RankingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(string $id) {

        if(auth()->user()->id == $id){
            
            $user = User::find($id);
            $ranking = User::all('id', 'username', 'score')->sortByDesc('score');
            return view('users.ranking')->with(['ranking' => $ranking, 'user' => $user]);

            } 
            return redirect()->back();
    }
}
