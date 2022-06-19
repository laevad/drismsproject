<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\User;

use App\Image;
use Auth;
use App\Permission;
use App\Evaluation;

use Illuminate\Http\Request;

class   InstructorController extends Controller
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
        //
        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);

        $users = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.role', 'Instructor')
        ->orderBy('created_at', 'DESC')
        ->get(['users.*', 'images.name as image_name']);
        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first();

        $permission_status = "";
        if($permission) {
            if($permission->instructor == "read_only") {
                $permission_status = "disabled";
            }
        }

        return view('admin/instructor', compact('users', 'profile_pic', 'permission_status'));
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
                ['users.role', '=', 'Instructor'],
                ['users.phone', 'LIKE', '%'.$search.'%'],
                ['users.gender', 'LIKE', '%'.$request->gender.'%']
            ])
            ->orwhere([
                ['users.role', '=', 'Instructor'],
                ['users.email', 'LIKE', '%'.$search.'%'],
                ['users.gender', 'LIKE', '%'.$request->gender.'%']
            ])
            ->orWhere([
                ['users.role', '=', 'Instructor'],
                ['users.fname', 'LIKE', '%'.$search.'%'],
                ['users.gender', 'LIKE', '%'.$request->gender.'%']
            ])
            ->orWhere([
                ['users.role', '=', 'Instructor'],
                ['users.lname', 'LIKE', '%'.$search.'%'],
                ['users.gender', 'LIKE', '%'.$request->gender.'%']
            ])
          ->orderBy('created_at', 'DESC')
          ->get(['users.*', 'images.name as image_name']);

            //addeded from index

            $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
            ->where('users.id', Auth::user()->id)
            ->get(['users.*', 'images.name as image_name']);

            $permission = Permission::where('staff_id', '=', Auth::user()->id)->first();

            $permission_status = "";
            if($permission) {
                if($permission->instructor == "read_only") {
                    $permission_status = "disabled";
                }
            }

            return view('admin/instructor', compact('users', 'profile_pic', 'permission_status'));

    }



    public function instructorEvaluation($classes, $classes_id, $instructor_id){


       return view('evaluation', compact('classes','classes_id', 'instructor_id'));
    }


    public function instructorStoreEvaluation(Request $request){

        $newEvaluation = new Evaluation();


        if($request->classes = 'practical'){
            $newEvaluation->fleet_schedule_id = $request->classes_id;
        }else{
            $newEvaluation->student_course_id = $request->classes_id;
        }
        $newEvaluation->student_id = Auth::user()->id;
        $newEvaluation->instructor_id = $request->instructor_id;


        $newEvaluation->classes = $request->classes;
        $newEvaluation->demonstrates_sensivity_to_students = $request->demonstrates_sensivity_to_students;
        $newEvaluation->keeps_accurate_records_of_students = $request->keeps_accurate_records_of_students;
        $newEvaluation->demonstrates_mastery_subject_matter = $request->demonstrates_mastery_subject_matter;
        $newEvaluation->creates_teaching_strategies = $request->creates_teaching_strategies;
        $newEvaluation->enhances_student_self_esteem = $request->enhances_student_self_esteem;
        $newEvaluation->encourage_students = $request->encourage_students;
        $newEvaluation->designs_and_implements_learning_conditions = $request->designs_and_implements_learning_conditions;
        $newEvaluation->comments = $request->comments;
        $newEvaluation->allow_comment_use = $request->allow_comment_use;
        $is_save = $newEvaluation->save();

        if($is_save){
            return  redirect()
                    ->back()
                    ->with('success', 'Successfully evaluate the Instructor!');
        }else{
            return  redirect()
                    ->back()
                    ->with('error', 'Failed to evaluate the Instructor!');
        }
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
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $existsUser = User::find($id);


        if($existsUser){
            $existsUser->status = $request->status;
            $is_save = $existsUser->save();
            if($is_save){
                return  redirect()
                    ->back()
                    ->with('success', 'Update instructor status!');
            }else{
                return  redirect()
                    ->back()
                    ->with('error', 'Failed to update instructor status!!!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        //
    }
}
