<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Staff; 
use App\User; 
use App\Image;
use App\Permission;
use Auth;
use Illuminate\Http\Request;

class StaffController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }  
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
        $users = User::join('images', 'users.id', '=', 'images.user_id')
                ->leftJoin('permissions as p', 'p.staff_id', '=', 'users.id')
            ->where('users.role', 'Staff')
            ->orderBy('users.created_at', 'DESC')
            ->get(['images.name as image_name', 'p.*','users.*']); 
        $branches = Branch::all(); 

        return view('admin/staff', compact('users', 'profile_pic', 'branches'));
     
    }



     /**
     * Search data from source storage
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){

        $search = $request->search;  

        $users = User::join('images', 'users.id', '=', 'images.user_id')
        ->where([
            ['users.role', '=', 'Staff'],
            ['users.phone', 'LIKE', '%'.$search.'%'] 
        ])
        ->orwhere([
            ['users.role', '=', 'Staff'],
            ['users.email', 'LIKE', '%'.$search.'%']
        ]) 
        ->orWhere([
            ['users.role', '=', 'Staff'],
            ['users.fname', 'LIKE', '%'.$search.'%'] 
        ]) 
      ->orderBy('created_at', 'DESC')
      ->get(['users.*', 'images.name as image_name']);

      


        //addeded from index


      $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
      ->where('users.id', Auth::user()->id)
      ->get(['users.*', 'images.name as image_name']);  


      $branches = Branch::all(); 



        return view('admin/staff', compact('users', 'profile_pic', 'branches'));
 
}




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $permission = Permission::where('staff_id', '=', $id)->first();
        if($permission){
            $permission->scheduling = $request->p_schedule;
            $permission->students = $request->p_student;
            $permission->instructor = $request->p_instructor;
            $permission->fleet = $request->p_fleet;
            $permission->branch = $request->p_branch;
            $permission->invoice = $request->p_invoice;
            $permission->course = $request->p_course;
            $permission->school = $request->p_school;
            $is_save = $permission->save();
                
            if($is_save){

                return redirect()->back()->with('success', 'Staff update successfully!');
    
            }else{

                return redirect()->back()->with('error', 'We have trouble updating staff.');
            }
        }else{

            return redirect()->back()->with('error', 'We have trouble updating staff.');
        }


 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
