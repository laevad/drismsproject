<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Branch;

use App\Day;
use App\SchoolCourse;


use App\Invoice;
use App\School;
use DB;


use App\StudentCourse;
use App\Fleet;
use App\FleetSchedule;

use App\Classes;
use App\Permission;

use App\Image;
use Auth;
class StudentController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);


        $students = User::join('images', 'users.id', '=', 'images.user_id')
        ->orderBy('users.fname')
        ->where('users.role', 'Student')
        ->get(['users.*', 'images.name as image_name']);


        $invoiceAmount = DB::table('invoices')
        ->select('*', 'courses.*', DB::raw('SUM(invoices.amount) As total_amount'))
        ->leftJoin('courses', 'courses.id', '=', 'invoices.course_id')
        ->where('invoices.user_id', 14)
        ->get();

        $courses = Course::orderBy('created_at', 'DESC')->get();

        $studentCourses = StudentCourse::join('school_course as sc', 'sc.id','=', 'student_course.school_course_id')
                                        ->join('courses as c', 'c.id', '=', 'sc.course_id')
                                        ->get(['c.*', 'sc.*', 'student_course.*']);

        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first();

        $permission_status = "";
        if($permission) {
            if($permission->students == "read_only") {
                $permission_status = "disabled";
            }
        }


        return view('admin/students', compact('courses', 'students', 'profile_pic', 'invoiceAmount', 'permission_status', 'studentCourses'));
    }

    /**
     * Search data from source storage
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){

        $search = $request->search;

        $students = User::join('images', 'users.id', '=', 'images.user_id')
        ->orderBy('created_at', 'DESC')
        ->where([
            ['users.role', '=', 'Student'],
            ['users.phone', 'LIKE', '%'.$search.'%'],
            ['users.gender', 'LIKE', '%'.$request->gender.'%']
        ])
        ->orwhere([
            ['users.role', '=', 'Student'],
            ['users.email', 'LIKE', '%'.$search.'%'],
            ['users.gender', 'LIKE', '%'.$request->gender.'%']
        ])
        ->orWhere([
            ['users.role', '=', 'Student'],
            ['users.fname', 'LIKE', '%'.$search.'%'],
            ['users.gender', 'LIKE', '%'.$request->gender.'%']
        ])
        ->orWhere([
            ['users.role', '=', 'Student'],
            ['users.lname', 'LIKE', '%'.$search.'%'],
            ['users.gender', 'LIKE', '%'.$request->gender.'%']
        ])
        ->orderBy('created_at', 'DESC')
        ->get(['users.*', 'images.name as image_name']);

        $courses = Course::orderBy('created_at', 'DESC')->get();


        //addeded from index

        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);


        $invoiceAmount = DB::table('invoices')
        ->select('*', 'courses.*', DB::raw('SUM(invoices.amount) As total_amount'))
        ->leftJoin('courses', 'courses.id', '=', 'invoices.course_id')
        ->where('invoices.user_id', 14)
        ->get();


        $studentCourses = StudentCourse::join('school_course as sc', 'sc.id','=', 'student_course.school_course_id')
                                        ->join('courses as c', 'c.id', '=', 'sc.course_id')
                                        ->get(['c.*', 'sc.*', 'student_course.*']);

        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first();

        $permission_status = "";
        if($permission) {
            if($permission->students == "read_only") {
                $permission_status = "disabled";
            }
        }

        return view('admin/students', compact('courses', 'students', 'profile_pic', 'invoiceAmount', 'permission_status', 'studentCourses'));
    }



    public function schedulinTheoretical(){

            $schools=School::all();
            $branches = Branch::all();
            $courses = Course::all();
            $school_courses =SchoolCourse::all();
            $days =Day::all();
            $users =  User::all();

        return view('student/schedule_theoretical', compact(
            'users',
            'schools',
            'branches',
            'school_courses',
            'courses',
            'days'
            )
        );
    }


    public function schedulingPractical(){

        $fleet_schedules = FleetSchedule::join('fleet as f', 'f.id', '=', 'fleet_schedules.fleet_id')
                                        ->join('users as u', 'u.id', '=', 'fleet_schedules.instructor_id')
                                        ->where('fleet_schedules.student_id', '=', 0)
                                        ->orWhere('fleet_schedules.student_id', '=', null)
                                        ->get(['u.fname as fname', 'u.lname as lname', 'f.*','fleet_schedules.*']);


        $single_fleet = FleetSchedule::where('student_id', '=', Auth::user()->id)->first();
//        dd(!empty($single_fleet) && Auth::user()->enrollment_status == null);

        return view('student/schedule_practical', compact('fleet_schedules', 'single_fleet'));
    }


    public function schedule(){

         $student_access_theoretical = StudentCourse::where([
            ['status', '=', 'completed'],
            ['evaluation', '=', 'pass'],
            ['student_id', '=', Auth::user()->id],
        ])->get();

        $student_access_practical = FleetSchedule::where([
            ['status', '=', 'completed'],
            ['evaluation', '=', 'pass'],
            ['student_id', '=', Auth::user()->id],
        ])->get();

//        dd($student_access_theoretical);
        return view('classes/index', compact('student_access_theoretical','student_access_practical'));
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
