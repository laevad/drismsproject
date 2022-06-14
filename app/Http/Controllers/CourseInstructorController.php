<?php

namespace App\Http\Controllers;

use App\CourseInstructor;
use Illuminate\Http\Request;

use App\User;
use App\Image;
use Auth;
class CourseInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseInstructor  $courseInstructor
     * @return \Illuminate\Http\Response
     */
    public function show(CourseInstructor $courseInstructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseInstructor  $courseInstructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseInstructor $courseInstructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseInstructor  $courseInstructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseInstructor $courseInstructor)
    {
        //
    }
}
