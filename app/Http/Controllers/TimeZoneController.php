<?php

namespace App\Http\Controllers;

use App\TimeZone;

use App\User;
use App\Image;
use Auth;

use Illuminate\Http\Request;

class TimeZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TimeZone  $timeZone
     * @return \Illuminate\Http\Response
     */
    public function show(TimeZone $timeZone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeZone  $timeZone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeZone $timeZone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeZone  $timeZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeZone $timeZone)
    {
        //
    }
}
