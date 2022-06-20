<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\Communication;
use App\Notification;



use App\Course;
use App\Branch;

use App\Day;
use App\SchoolCourse;

use App\School;
use Twilio\Rest\Client;


use App\User;



use App\Classes;
use App\StudentCourse;
use App\Image;
use App\Permission;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $communication = Communication::all();

        dd($communication);
        return view('auth.register', compact('communication'));
    }

    public function sendError($title, $error)
    {
        return redirect()->back()->with("error", $error->fname);
    }

    public function createStudent(Request $request)
    {




        // $validator = Validator::make($request->all(), [
        //         'fname' => 'required',
        //         'lname' => 'required',
        //         'username' => 'required',
        //         'address' => 'required',
        //         'address' => 'required',
        //         'dob' => 'required',
        //         'phone' => 'required',
        //         'role' => 'required',
        //         'email' => 'required|email',
        //         'gender' => 'required',
        //         'password' => 'required|confirmed',
        //     ]);


        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users|regex:/^\S*$/u',
            'address' => 'required|string|max:255',
            'dob' => 'required|before:5 years ago',
            'phone' => 'required|string|max:255',
            'role' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string',
            'password' => 'required|string|min:4|confirmed',
        ]);


        // $validator = Validator::make($request->all(), [
        //     'fname' => ['required', 'string', 'max:255'],
        //     'lname' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^\S*$/u'],
        //     'address' => ['required', 'string', 'max:255'],
        //     'dob' => ['required', 'before:5 years ago'],
        //     'phone' => ['required', 'string', 'max:255'],
        //     'role' => ['required', 'string'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'gender' => ['required', 'string'],
        //     'password' => ['required', 'string', 'min:4', 'confirmed'],
        // ]);


        // if ($validator->fails()) return $this->sendError('Validation Error.', $validator->errors());





        //  DB::beginTransaction();

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->save();




        $notification_user_id = User::where('role', 'Admin')->first();


        if ($notification_user_id) {
            $notification_user_id = $notification_user_id->id;
        } else {
            $notification_user_id = NULL;
        }



        $image = $request->profile_image;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10) . '.png';

        //$is_store = Storage::disk('public')->put($imageName, base64_decode($image));

        $is_store = Storage::disk('local')->put($imageName, base64_decode($image));




        if ($is_store) {

            $imagemodel = new Image();
            $imagemodel->name = "$imageName";
            $imagemodel->user_id = $user->id;
            $imagemodel->save();



//            if ($user) {
//
//
//                if (isset($request->rg_stdnt)) {
//                    $data1 = '';
//
//                    foreach ($request->where_did_you_know_school_ as  $key => $val) {
//                        if ($key == array_key_last($request->where_did_you_know_school_)) {
//                            $data1 .= '' . $val;
//                        } else {
//                            $data1 .= '' . $val . ', ';
//                        }
//                    }
//
//                    $newStudentEnrollment = new StudentCourse();
//
//                    $newStudentEnrollment->student_id = $user->id;
//
//                    if (!empty($data1)) {
//                        $newStudentEnrollment->where_did_you_know_school_ = $data1;
//                    }
//
//                    if (!empty($request->school_id)) {
//                        $newStudentEnrollment->school_id = $request->school_id;
//                    }
//
//
//
//                    if (!empty($request->school_course_id)) {
//                        $newStudentEnrollment->school_course_id = $request->school_course_id;
//                    }
//
//
//
//                    if (!empty($request->driving_lto_requirement)) {
//                        $newStudentEnrollment->driving_lto_requirement = $request->driving_lto_requirement;
//                    }
//
//
//                    if (!empty($request->theoretical_driving_course)) {
//                        $newStudentEnrollment->theoretical_driving_course = $request->theoretical_driving_course;
//                    }
//
//
//
//                    if (!empty($request->practical_driving_course_mv)) {
//                        $newStudentEnrollment->practical_driving_course_mv = $request->practical_driving_course_mv;
//                    }
//
//                    if (!empty($request->manual_transmission_mv)) {
//                        $newStudentEnrollment->manual_transmission_mv = $request->manual_transmission_mv;
//                    }
//
//
//                    if (!empty($request->automatic_transmission_mv)) {
//                        $newStudentEnrollment->automatic_transmission_mv = $request->automatic_transmission_mv;
//                    }
//
//
//                    if (!empty($request->practical_driving_course_mc)) {
//                        $newStudentEnrollment->practical_driving_course_mc = $request->practical_driving_course_mc;
//                    }
//
//                    if (!empty($request->manual_transmission_mc)) {
//                        $newStudentEnrollment->manual_transmission_mc = $request->manual_transmission_mc;
//                    }
//
//
//                    if (!empty($request->automatic_transmission_mc)) {
//                        $newStudentEnrollment->automatic_transmission_mc = $request->automatic_transmission_mc;
//                    }
//
//                    if (!empty($request->automatic_transmission_mc)) {
//                        $newStudentEnrollment->others_mc = $request->others_mc;
//                    }
//
//
//                    if (!empty($data1)) {
//                        $newStudentEnrollment->where_did_you_know_school_ = $data1;
//                    }
//
//
//
//
//                    $is_save1 = $newStudentEnrollment->save();
//
//
//
//                    if ($is_save1) {
//                        $newClass = new Classes();
//                        $newClass->student_id = $user->id;
//                        $newClass->school_id = $request->school_id;
//                        $newClass->course_id = $request->course_id;
//                        $is_save = $newClass->save();
//
//
//                        if ($is_save) {
//
//                            $id = $user->id;
//                            $existUser = User::find($id);
//                            $existUser->enrollment_status = 1;
//                            $existUser->save();
//
//
//                            $notification = new Notification();
//                            // $notification->image_id = $imagemodel->id;
//                            $notification->user_id = $user->id;
//                            $notification->status = 'active';
//                            $notification->type = 'message';
//                            $notification->message = "You are successfully enrolled you can go to your theoretical for more info.";
//                            $notification->save();
//
//                            $user_notify = User::Where('id', '=', $user->id)->first();
//
//                            $notification1 = new Notification();
//                            // $notification->image_id = $imagemodel->id;
//                            $notification1->user_id = $request->instructor_id;
//                            $notification1->status = 'active';
//                            $notification1->type = 'message';
//                            $notification1->message = "Student <strong>" . $user_notify->fname . ' ' . $user_notify->lname . "</strong> enrolled to your course";;
//                            $notification1->save();
//
//                            return  redirect()
//                                ->back()
//                                ->with('success', 'Congratualation!');
//                        } else {
//                            return  redirect()
//                                ->back()
//                                ->with('error', 'Failed to save data!!!');
//                        }
//                    }
//                }
//            }
        }
        $fname = $request->fname;
        $lname = $request->lname;
        $role = $request->role;

        $notification = new Notification();
        $notification->image_id = $imagemodel->id;
        $notification->user_id = $notification_user_id;
        $notification->status = 'active';
        $notification->type = 'newaccount';
        $notification->message = "New $role account created for <strong>$fname $lname</strong>.";
        $notification->save();


        if ($role == 'Staff') {
            $permission = new Permission();
            $permission->staff_id = $user->id;
            $permission->save();
        }
        //   Auth::login($userFace);
        //  DB::commit();
        return redirect('/');
    }
    public function studentRegistration()
    {



        //  $sid = "ACf391c727eaecbd5b0de2f4ed7b213af5"; // Your Account SID from www.twilio.com/console
        // $token = "2bf00addc37959fb9bacf5fc20eb67fe"; // Your Auth Token from www.twilio.com/console

        // $client = new Twilio\Rest\Client($sid, $token);
        // $message = $client->messages->create(
        //     '+63967520070', // Text this number
        //     [
        //     'from' => '+12134938794', // From a valid Twilio number
        //     'body' => 'Hello from Twilio!'
        //     ]
        // );

        // print $message->sid;


        $schools = School::all();
        $branches = Branch::all();
        $courses = Course::all();
        $school_courses = SchoolCourse::all();
        $days = Day::all();

        return view('auth/student_registration', compact('schools', 'branches', 'school_courses', 'courses', 'days'));
    }

    public function index()
    {
        // if (!extension_loaded('imagick')){
        //     echo 'imagick not installed';
        // }
        // phpinfo();


        return view('welcome');
    }

    public function contactUs()
    {
        return view('contact');
    }

    public function sendEmail(Request $request)
    {
        $from_email = $request->email;


        $is_Admin = User::where('role', 'Admin')->first();


        $to_email = $is_Admin->email;
        $to_name = $is_Admin->fname . ' ' . $is_Admin->lname;


        $from_name = $request->name;
        $subject = $request->subject;

        $data = array(
            'name' => "$from_name",
            'from_email' => $from_email,
            'body' => $request->message
        );


        \Mail::send(
            'emails.mail',
            $data,
            function ($message) use ($to_name, $to_email, $from_email, $from_name, $subject) {
                $message->from($from_email, "From $from_name");
                $message->to($to_email, $to_name)->subject($subject);
            }
        );




        $notification1 = new Notification();
        $notification1->user_id = $is_Admin->id;
        $notification1->status = 'active';
        $notification1->type = 'message';
        $notification1->message = "<br /> $request->message <br/><small>Type: email </small><br/><small>Sender: " . $from_name . "</small> ";
        $notification1->save();


        return redirect()->back()->with('sendEmailMs', "Send email successfully!!!");
    }
}
