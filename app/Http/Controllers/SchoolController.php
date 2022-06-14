<?php

namespace App\Http\Controllers;

use App\School;

use App\User;
use App\Image;
use App\Communication;
use App\Communication_user_school_branch; 

use App\Day;

use App\Course;
use App\Branch;
use App\SchoolCourse;

use Auth;
use Mail;

use App\Permission;
use App\SmsGateWay;

use App\Notification;

use Illuminate\Http\Request;

class SchoolController extends Controller
{

    
    // protected $mail;
    
    // /**
    //  * Create the event listener.
    //  *
    //  * @param Mail $mail
    //  */
    public function __construct(Mail $mail)
    {

        $this->middleware('auth');   
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();  
            if($this->user->role == 'Instructor' || $this->user->role == 'Student'){
                return redirect()->back();
            } 
            return $next($request);
        });  
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

        $schools = School::orderBy('Created_at', 'DESC')->get();
         
        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first(); 
        $permission_status = "";
        $permission_delete = "";
        if($permission) {
            if($permission->branch == "read_only") {
                $permission_status = "disabled";
            }else if($permission->branch == "read_write") {
                $permission_delete = "disabled";
                $permission_status = "";
            }else if($permission->branch == "read_write_delete") {
                $permission_status = "";
                $permission_delete = "";
            } 
        }


        return view('admin/school', compact('schools', 'profile_pic', 'permission_status', 'permission_delete'));
    }


    public function sendEmail(Request $request){
       
        $school_ = School::where('id', '=', $request->school_id)->first();
         
        $communication = new Communication();
        $communication->type = 'email'; 
        $communication->suject = $request->subject_m; 
        $communication->messages =  $request->message;  
        $communication->save();

        $communication_user_school_branch = new Communication_user_school_branch();
        $communication_user_school_branch->user_sender_id = auth()->id();
        $communication_user_school_branch->school_receiver_id = $request->school_id;
        $communication_user_school_branch->comm_id =$communication->id;
    
        $communication_user_school_branch->save();
 
        $to_name = $school_->name;
        $to_email = $school_->email;
        $subject = $request->subject_m;

        $data = array(
                'name'=>"$to_name", 
                'body' => $request->message
            );
        $is_send = Mail::send(
                'emails.mail', 
                $data, 
            function($message) use ($to_name, $to_email, $subject)
            {
                $message->from(Auth::user()->email,"from ".Auth::user()->fname);
                $message->to($to_email, $to_name)->subject($subject);
            }
        );
    
        if($is_send){

            return redirect()->back()->with('success', 'Email has been sent!');
 
        }else{

            return redirect()->back()->with('error', 'We have trouble sending your email!');
        }
    }



    /**
     *  @send sms using traccar sms getway 
     * 
     */
    public function sendSms(Request $request){
 
        $school_phone = School::where('id', '=', $request->school_id)->first();
         
        $communication = new Communication();
        $communication->type = 'sms'; 
        $communication->messages =  $request->message;  
        $communication->save();

        $communication_user_school_branch = new Communication_user_school_branch();
        $communication_user_school_branch->user_sender_id = auth()->id();
        $communication_user_school_branch->school_receiver_id = $request->school_id;
        $communication_user_school_branch->comm_id =$communication->id;
    
        $communication_user_school_branch->save();



        $existSmsGateWay = SmsGateWay::where('user_id', '=', Auth::user()->id)->first();

        if($existSmsGateWay){  
                
            $apikey = "$existSmsGateWay->api_key";
            //$to = '09676620398';  
            $to = $school_phone->phone; 
            $message = $request->message;
            $mobile_ip =  "$existSmsGateWay->mobile_ip"; 
    
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $mobile_ip);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"to\":\"$to\",\"message\":\"$message\"}");

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: ' . $apikey)
            );

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
            // echo 'Error:' . curl_error($ch);
                return redirect()->back()->with('error', "We have error to send your sms " . curl_error($ch) . "!");
            }
            curl_close($ch);

        }
        return redirect()->back()->with('success', 'Sent SMS successfully!!!');
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
            'name' => 'required|unique:schools|max:255',
            'email' => 'required|string|email|max:255|unique:schools',
            'phone' => 'required',
            'address' => 'required ',
        ]);
        
        //validate number numeric|min:2|max:5

        $school = new School();
        $school->name = $request->name;
        $school->email = $request->email;
        $school->phone = $request->phone;
        $school->address = $request->address;
        $is_save = $school->save();
        if($is_save){
            return  redirect()
                    ->back()
                    ->with('success', 'New school record saved!');
        }else{ 
            return  redirect()
                    ->back()
                    ->with('error', 'Failed to save data!!!');
        } 
    }


    public function addCourse($id){
         

        //should not included to display, to be review
    
        // $courses = Course::leftJoin('school_course as sc', 'sc.course_id', '=', 'courses.id' )  
        //         ->leftJoin('schools as s', 's.id', '=', 'sc.school_id')  
        //         ->where('s.id', '=', $id) 
        //         ->get(['courses.*']);
        // dd($courses);
 
        $courses = Course::all(); 
        $school_courses = SchoolCourse::all();  
  
        $school = School::where('id', $id)->first(); 

        $instructors = User::where('role', '=', 'Instructor')->get();
         

        $branches = Branch::where('school_id', '=', $id)->get();

        return view('admin/form/addSchoolCourse', compact('branches','courses', 'school', 'school_courses', 'instructors'))->with('id', $id);
    }



    public function reviewCourse($id){

        $school_corses = SchoolCourse::leftJoin('days as d', 'd.sc_id', '=', 'school_course.id')
                        ->leftJoin('courses as c', 'c.id', '=', 'school_course.course_id')
                        ->where('school_course.school_id', '=', $id)
                        ->orderBy('c.created_at', 'desc') 
                        ->get(['c.*', 'd.*', 'school_course.*']); 

        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first(); 
        $permission_status = "";
        $permission_delete = "";
        if($permission) {
            if($permission->branch == "read_only") {
                $permission_status = "disabled";
            }else if($permission->branch == "read_write") {
                $permission_delete = "disabled";
                $permission_status = "";
            }else if($permission->branch == "read_write_delete") {
                $permission_status = "";
                $permission_delete = "";
            } 
        }
                
                        
        return view('admin/review/reviewCourseSchool', compact('school_corses', 'id', 'permission_status', 'permission_delete')); 
    }


    public function courseSchoolStore(Request $request){
         
            // $existSC = SchoolCourse::whereIn('course_id', $request->course_id, 'amd')
            // ->whereIn('school_id', $request->school_id )->get();
            //dd($request);
            $data = ''; 
            foreach($request->day as $key => $val){ 
                if($key == array_key_last($request->day)){
                    $data .= '' . $val;
                }else{ 
                    $data .= '' . $val . ', ';
                }
            } 
            $scs = SchoolCourse::all();

            $status = false;
            foreach($scs as $sc){
                if($sc->course_id == $request->course_id && $sc->school_id == $request->school_id){
                    $status = true;
                }
            }

            // if($status){
                
            //     return  redirect()
            //             ->back()
            //             ->with('exist', 'Course already exists.'); 
            // }else{ 

                
                $newCourse = new SchoolCourse(); 
                
                $newCourse->time_start_end = $request->start_end;
                $newCourse->start = $request->start;
                $newCourse->end = $request->end;
                $newCourse->duration = $request->duration;
                $newCourse->period = $request->period; 
                $newCourse->school_id = $request->school_id;
                // $newCourse->branch_id = $request->branch_id;
                $newCourse->instructor_id = $request->instructor_id; 
                $newCourse->course_id = $request->course_id; 
                $newCourse->save();  

                $day = new Day();
                $day->day = $data;
                $day->sc_id = $newCourse->id;
                $is_save = $day->save(); 


                if($is_save){ 

                    return redirect() 
                            ->back()
                            ->with('success', 'New Course record added!');
                
                 
                }else{ 
                    return redirect()
                            ->back()
                            ->with('error', 'Failed to save data!!!');
                } 
            
           // }
        //DB::beginTransaction();

        // try {
        //     DB::insert(...);
        //     DB::insert(...);
        //     DB::insert(...);

        //     DB::commit();
        //     // all good
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     // something went wrong
        // }
    }

    public function scDelete($id){
        
        $existingSC = SchoolCourse::find( $id );
        
        if( $existingSC )
        {

            $existingSC->delete();  

            $day = Day::where('sc_id', '=', $id)->first();
            $existingDay = Day::find($day->id); 

            $existingDay->delete(); 

            return  redirect()->back()->with('success', 'School Course deleted successfully!');
        } 
        return redirect()->back()->with('error', 'Sorry, we have trouble to delete data from School ');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required',
            'address' => 'required ',
        ]);

        $existingSchool = School::find($id);
        
        if($existingSchool){ 
            $existingSchool->name = $request->name;
            $existingSchool->email = $request->email;
            $existingSchool->phone = $request->phone;
            $existingSchool->address = $request->address;
            $is_save = $existingSchool->save();
            if($is_save){
                return  redirect()
                        ->back()
                        ->with('success', 'Successfully update the school!');
            }else{ 
                return  redirect()
                        ->back()
                        ->with('error', 'Failed to update the school!');
            } 
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
 
        $existingSchool = School::find( $id );

        if( $existingSchool )
        { 

            $existingSchool->status = "Suspended";
            $is_save = $existingSchool->save();

            $notification1 = new Notification();
            // $notification->image_id = $imagemodel->id;
            $notification1->user_id = Auth::user()->id;
            $notification1->status = 'active';
            $notification1->type = 'delete';
            $notification1->message = "School ( $existingSchool->name ) has been suspended by: " . Auth::user()->fname . ' '. Auth::user()->lname. "</strong> ";
            $notification1->save();

            return  redirect()->back()->with('success', 'School Suspended successfully!');
        } 
        return redirect()->back()->with('error', 'Sorry, we have trouble to update data from School');
 
    }
}
