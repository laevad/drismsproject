<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;
use App\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user =  User::find($request->user_id);

        if($request->has("fname") &&
            $request->has("lname") &&
            $request->has("email") &&
            $request->has("phone") &&
            $request->has("dob") &&
            $request->has("gender") &&
            $request->has("address")){
            $user->lname = $request->input("lname");
            $user->fname = $request->input("fname");
            $user->email = $request->input("email");
            $user->phone = $request->input("phone");
            $user->dob = $request->input("dob");
            $user->gender = $request->input("gender");
            $user->address = $request->input("address");
        }
        $user->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        //
        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);


        $user = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('username','=',$username)
        ->get(['users.*', 'images.name as image_name'])->first();


        return view('profile', compact('user', 'profile_pic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
