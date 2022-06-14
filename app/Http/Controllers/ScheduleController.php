<?php

namespace App\Http\Controllers;

use App\Schedule;

use App\User;
use App\Image;


use App\Fleet; 
use App\FleetSchedule;


use App\StudentCourse;
use App\SchoolCourse;

use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
 
        return view('admin/scheduling', compact('profile_pic'));
    } 
    public function theoretical(){
        
        $studentcourses = StudentCourse::rightJoin('users as u', 'u.id', '=', 'student_course.student_id') 
                            ->leftJoin('school_course as sc', 'sc.id', '=', 'student_course.school_course_id')
                            ->join('schools as s', 's.id', '=', 'student_course.school_id')
                            ->leftJoin('branches as b', 'b.id', '=', 'student_course.branch_id')
                            ->join('courses as c', 'c.id', '=', 'sc.course_id')
                            ->join('days as d', 'd.sc_id', '=', 'sc.id')
                            ->where('student_course.student_id', '=', Auth::user()->id)
                            ->first([
                                'd.day as day',
                                'c.name as c_name', 
                                'c.price as c_price', 
                                'sc.*','s.name as s_name', 
                                's.address as s_address',
                                'b.name as b_name', 
                                'b.address as b_address', 
                                'student_course.*', 'student_course.id as student_course_id', 
                                'u.*'
                            ]);    
                         
        //not used
        $instructorCourse = StudentCourse::leftJoin('school_course as sc', 'sc.id', '=', 'student_course.school_course_id')
                        ->join('schools as s', 's.id', '=', 'student_course.school_id')
                        ->leftJoin('branches as b', 'b.id', '=', 'student_course.branch_id')
                        ->join('users as u', 'u.id', '=', 'student_course.student_id') 
                        ->join('courses as c', 'c.id', '=', 'sc.course_id')
                        ->join('days as d', 'd.sc_id', '=', 'sc.id')
                        ->where([ 
                            ['sc.instructor_id', '=', Auth::user()->id] 
                        ])
                       ->get(['d.day as day','c.name as c_name', 'c.price as c_price', 'sc.*','s.name as s_name', 's.address as s_address','b.name as b_name', 'b.address as b_address', 'student_course.*', 'u.*']);  
  
         
        //not used end


        $instructor_school_course = SchoolCourse::join('users as u', 'u.id', '=', 'school_course.instructor_id')
                                                ->join('schools as s', 's.id', '=', 'school_course.school_id')
                                                ->join('courses as c', 'c.id', '=', 'school_course.course_id') 
                                                ->join('days as d', 'd.sc_id', '=', 'school_course.id')
                                                ->where('school_course.instructor_id', '=', Auth::user()->id)
                                                ->get(['c.name as c_name','d.day as day','s.name as s_name','school_course.*']);
    


        return view('theoretical', compact('studentcourses', 'instructorCourse', 'instructor_school_course'));
    }

    public function instructorTheoreticalViewStudent($id){
 
        $view_student_enroll = StudentCourse::join('school_course as sc', 'sc.id', 'student_course.school_course_id')
                        ->join('users as u', 'u.id', '=', 'student_course.student_id')
                        ->where('student_course.school_course_id', '=', $id)
                        ->orderBy('student_course.id', 'desc')
                        ->get(['u.fname as fname', 'u.lname as lname', 'student_course.*']);

                //   dd($view_student_enroll);
       return view('instructor/view/theoretical', compact('view_student_enroll'));
    }

    public function instructorTheoreticalUpdateStudent(Request $request, $id){ 
        $exists = StudentCourse::find($id);  
        if($exists){ 
            $exists->status = 'completed';
            $exists->evaluation = $request->evaluation;
            $is_save = $exists->save();
            if($is_save){
                return  redirect()
                        ->back()
                        ->with('success', 'Successfully evaluate the student!');
            }else{ 
                return  redirect()
                        ->back()
                        ->with('error', 'Failed to evaluate the student!');
            } 
        } 
    }




    public function practical(){    

            $fleet_schedule = FleetSchedule::join('fleet as f', 'f.id', '=', 'fleet_schedules.fleet_id')
                        ->join('users as u', 'u.id', '=', 'fleet_schedules.instructor_id')
                        ->where('fleet_schedules.student_id', '=', Auth::user()->id )
                        ->first(['u.*', 'f.*', 'fleet_schedules.*']);
            
       
            $instructor_fleet_schedule = FleetSchedule::join('users as u', 'u.id', '=', 'fleet_schedules.student_id')
                        ->join('fleet as f', 'f.id', '=', 'fleet_schedules.fleet_id')
                        ->where('fleet_schedules.instructor_id', '=', Auth::user()->id )
                        ->get(['u.fname as fname','u.lname as lname', 'fleet_schedules.*']);
                         

                        // dd($fleet_schedule);

        return view('practical', compact('fleet_schedule', 'instructor_fleet_schedule')); 
    }
 
    
    public function instructorPracticalUpdateStudent(Request $request, $id){
        
        $exists = FleetSchedule::find($id); 
         
        if($exists){ 

            date_default_timezone_set('Asia/Manila');

            // echo date('M-d-y') . ' at '. date('h:i:sa');


            $words1 = preg_split('//', 'abcdefghijklmnopqrstuvwxyz0123456789', -1);

            shuffle($words1);

            $words2 = preg_split('//', 'abcdefghijklmnopqrstuvwxyz0123456789', -1);

            shuffle($words2);

            $str1="";
            $str2="";
            $str3="";
            for($i = 0; $i < 5; $i++) {
                $str1 .= strtoupper($words1[$i]);
                $str2 .= strtoupper($words2[$i]); 
            }
        
            for($i = 0; $i < 10; $i++) {
                $str3 .= strtoupper($words1[$i]); 
            } 
            $exists->driver_license_no = 'DRISMS-'.$str1 .'-' .$str2;
            $exists->control_no = 'DS-'.$str3. '-'. substr(date('M'), 0, 1). '-'.date('Y'). '-'.  $id;
            $exists->date_issue = date('M-d-y') . ' at '. date('h:i:sa');
            $exists->status = 'completed';
            $exists->evaluation = $request->evaluation;
            $is_save = $exists->save();


            if($is_save){
                return  redirect()
                        ->back()
                        ->with('success', 'Successfully evaluate the student!');
            }else{ 
                return  redirect()
                        ->back()
                        ->with('error', 'Failed to evaluate the student!');
            }  
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
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $user = User::where('id', '=', $id)->first(); 
 
        $fleets = Fleet::leftJoin('fleet_schedules as fs', 'fs.fleet_id', '=', "fleet.id") 
                            ->where('fs.instructor_id', '=', $id)
                            ->orderBy('fs.created_at', 'desc')
                            ->get(['fleet.*', 'fs.*']);

                            
        $school_course_instructors = SchoolCourse::join('users as u', 'u.id', '=', 'school_course.instructor_id')
                            ->join('courses as c', 'c.id', '=', 'school_course.course_id')
                            ->join('schools as s', 's.id', '=', 'school_course.school_id')
                            ->leftJoin('branches as b', 'b.id', '=', 'school_course.branch_id')
                            ->join('days as d', 'd.sc_id','=', 'school_course.id')
                            ->where('school_course.instructor_id', '=', $id)
                            ->orderBy('school_course.created_at', 'desc')
                            ->get(
                                ['u.fname as fname', 
                                'u.lname as lname', 
                                'c.name as c_name', 
                                'c.price', 
                                's.name as s_name',
                                'b.name as b_name',
                                'd.day as days',
                                'school_course.*'
                                ]
                            );
 
 
        return view('admin/review/reviewInstructorSchedule', compact('user', 'fleets', 'school_course_instructors')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
