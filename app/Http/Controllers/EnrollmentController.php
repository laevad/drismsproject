<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Course;
use App\Branch;
  
use App\School;  
use App\StudentCourse;
use App\Classes;
 
use App\Student;
use Auth;

 


use App\Day;
 
use App\SchoolCourse;
   
use App\Notification;

use App\Image;

use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    //

 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    } 
    
    public function enrollment(){  
        // $school_corses = SchoolCourse::leftJoin('days as d', 'd.sc_id', '=', 'school_course.id')
        // ->leftJoin('courses as c', 'c.id', '=', 'school_course.course_id')
        // ->where('school_course.school_id', '=', 3)
        // ->orderBy('c.created_at', 'desc') 
        // ->get(['c.*', 'd.*', 'school_course.*']); 
        // dd($school_corses); 
        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);

        $schools = School::all();  
        return view('student/enrollment', compact('schools', 'profile_pic'));
    }


    public function getEnrollmentBranch($id){ 
        $branches = Branch::where('school_id', '=', $id)->get();   
        return $branches; 
    }


    public function getEnrollmentCourse($school_id, $course_id){ 
        $schools = School::leftJoin('school_course as sc', 'sc.school_id', '=', 'schools.id')
                    ->leftJoin('courses as c', 'sc.course_id', '=', 'c.id')    
                    ->where('sc.school_id', '=', $school_id)
                    ->get(['c.*', 'sc.*']);   
 
        return $schools; 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
 
        $request->validate([
            'student_id' => 'unique:student_course', 
        ]); 

        $data = ''; 
        foreach($request->where_did_you_know_school_ as $key => $val){ 
            if($key == array_key_last($request->where_did_you_know_school_)){
                $data .= '' . $val;
            }else{ 
                $data .= '' . $val . ', ';
            }
        } 
 
        $newStudentEnrollment = new StudentCourse();

        $newStudentEnrollment->student_id = Auth::user()->id;
        $newStudentEnrollment->school_id = $request->school_id;
        $newStudentEnrollment->branch_id = $request->branch_id;
        $newStudentEnrollment->school_course_id = $request->school_course_id; 

        $newStudentEnrollment->driving_lto_requirement = $request->driving_lto_requirement;
        $newStudentEnrollment->theoretical_driving_course = $request->theoretical_driving_course;
        
        $newStudentEnrollment->practical_driving_course_mv = $request->practical_driving_course_mv;
        $newStudentEnrollment->manual_transmission_mv = $request->manual_transmission_mv;
        $newStudentEnrollment->automatic_transmission_mv = $request->automatic_transmission_mv;
 
        $newStudentEnrollment->practical_driving_course_mc = $request->practical_driving_course_mc;
        $newStudentEnrollment->manual_transmission_mc = $request->manual_transmission_mc;
        $newStudentEnrollment->automatic_transmission_mc = $request->automatic_transmission_mc;
        $newStudentEnrollment->others_mc = $request->others_mc;

        $newStudentEnrollment->where_did_you_know_school_ = $data;

        // $newStudentEnrollment->civil_status = $request->civil_status;
        // $newStudentEnrollment->pob = $request->pob;
        // $newStudentEnrollment->height = $request->height;
        // $newStudentEnrollment->weigth = $request->weigth;
        // $newStudentEnrollment->blood_type = $request->blood_type;

        // $newStudentEnrollment->name_of_mother = $request->name_of_mother;
        // $newStudentEnrollment->name_of_father = $request->name_of_father;
        // $newStudentEnrollment->person_notify_in_case_of_emergency = $request->person_notify_in_case_of_emergency;
        // $newStudentEnrollment->guardian_address = $request->guardian_address;
        // $newStudentEnrollment->guardian_number = $request->guardian_number;
        // $newStudentEnrollment->guardian_pob = $request->guardian_pob;
        // $newStudentEnrollment->guardian_relation = $request->guardian_relation;
        // $newStudentEnrollment->orno = $request->or_no;
        // $newStudentEnrollment->amount_paid = $request->amount_paid;
        
        // $newStudentEnrollment->y_e = $request->y_e;


        $is_save = $newStudentEnrollment->save(); 
        
        if($is_save){
            $newClass = new Classes();
            $newClass->student_id = Auth::user()->id;
            $newClass->school_id = $request->school_id;
            $newClass->course_id = $request->course_id;  
            $is_save = $newClass->save();  

            if($is_save){ 
                    
                $id = Auth::user()->id;
                $existUser = User::find($id);
                $existUser->enrollment_status = 1;
                $existUser->save(); 
  

                $notification = new Notification();
                // $notification->image_id = $imagemodel->id;
                $notification->user_id = Auth::user()->id;
                $notification->status = 'active';
                $notification->type = 'message';
                $notification->message = "You are successfully enrolled you can go to your theoretical for more info.";
                $notification->save();
 
                $user_notify = User::Where('id', '=', Auth::user()->id)->first(); 

                $notification1 = new Notification();
                // $notification->image_id = $imagemodel->id;
                $notification1->user_id = $request->instructor_id;
                $notification1->status = 'active';
                $notification1->type = 'message';
                $notification1->message = "Student <strong>" . $user_notify->fname . ' '. $user_notify->lname. "</strong> enrolled to your course";;
                $notification1->save();
                




                return  redirect()
                        ->back()
                        ->with('success', 'Congratualation!');
            }else{ 
                return  redirect()
                        ->back()
                        ->with('error', 'Failed to save data!!!');
            } 
        
        } 
    }

}


