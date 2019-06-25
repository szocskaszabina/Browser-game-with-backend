<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

//Show any users profile

    public function show(string $id) {

        $user = User::find($id);
        return view('users.profile')->with('user', $user);
    }

//Show form for editing user values

    public function edit( string $id)
    {   
        
        if(Auth::user()->id == $id){

        $user = User::find($id);
        
        return view('users.edit')->with('user', $user);
        } else {
            return redirect()->back();
        }
    }

//Update user values

    public function update(Request $req, string $id)
    {   

        if(Auth::user()->id == $id){

            $this->validate($req, [
                'username' => 'required',
                'email' => 'required',
                'avatar' => 'image|nullable|max:1999'
            ]);

            //Handle file upload
            if($req->hasFile('avatar')){
            //Get filename with extension
            $fullFilename = $req->file('avatar')->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($fullFilename, PATHINFO_FILENAME );
            //Get just extension
            $ext = $req->file('avatar')->getClientOriginalExtension();

            $filenameToStore = $filename.'_'.time().'.'.$ext;

            $path = $req->file('avatar')->storeAs('public/avatar', $filenameToStore);


        }

            // Create User Object
            $user = User::find($id);
            $user->username = $req->input('username');
            $user->email = $req->input('email');
            if($req->hasFile('avatar')){
                $user->avatar = $filenameToStore;
            };
            $user->save();
            return redirect()->route('profile', ['user_id' => $id]);

            } else {
                return redirect()->back();
            }
    }

//Delete user

    public function destroy(string $id)
    {
            if(Auth::user()->id == $id){
                //Delete user
                $user = User::find($id);
                $user->delete();
                return redirect('/');
            }
            return redirect()->back();
    }

//Update score points of current user

    public function scoreUpdate(Request $req, string $id)
    {
        $data = $req->all(); 

        if(Auth::user()->id == $id){
            
            $user = User::find($id);
            $user->increment('score', (int)$data[0]);
            
            return response()->json([
                'error' => false,
                'points'  => $data,
            ], 200);
        }

        return redirect()->back();
            
    }
}
