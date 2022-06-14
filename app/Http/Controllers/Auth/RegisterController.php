<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Classes;
use App\StudentCourse;
use App\Image;
use App\Permission;
use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        //     $schools=School::all();
        //     $branches = Branch::all();
        //     $courses = Course::all();
        //     $school_courses =SchoolCourse::all();
        //     $days =Day::all();

        // return view('student/schedule_theoretical', compact('schools', 'branches', 'school_courses', 'courses', 'days'));


        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^\S*$/u'],
            'address' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'before:5 years ago'],
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $data['username'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
        ]);

        $notification_user_id = User::where('role', 'Admin')->first();

        if ($notification_user_id) {
            $notification_user_id = $notification_user_id->id;
        } else {
            $notification_user_id = NULL;
        }



        $image = $data['profile_image'];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10) . '.png';

        //$is_store =$image->move(public_path('/images'),$imageName);


        //$is_store = Storage::disk('public')->put($imageName, base64_decode($image));
        $is_store = Storage::disk('local')->put($imageName, base64_decode($image));



        // $userFace = array(
        //             'fname' => $data['fname'],
        //             'lname' => $data['lname'],
        //             'username' => $data['username'],
        //             'address' => $data['address'],
        //             'dob' => $data['dob'],
        //             'phone' => $data['phone'],
        //             'role' => $data['role'],
        //             'email' => $data['email'],
        //             'gender' => $data['gender'],
        //             'password' => Hash::make($data['password']),
        //     );

        //     $user = new User;
        //     $user->fname = $userFace['lname'];
        //     $user->lname = $userFace['fname'];
        //     $user->username = $userFace['username'];
        //     $user->address = $userFace['address'];
        //     $user->dob = $userFace['dob'];
        //     $user->phone = $userFace['phone'];
        //     $user->role = $userFace['role'];
        //     $user->email = $userFace['email'];
        //     $user->gender = $userFace['gender'];
        //     $user->password = $userFace['password'];
        //     $user->save();




        //   /*        dd($userFace['name']);


        //          */


        if ($is_store) {

            $imagemodel = new Image();
            $imagemodel->name = "$imageName";
            $imagemodel->user_id = $user->id;
            $imagemodel->save();



            if ($user) {


                if (isset($data['rg_stdnt'])) {
                    $data1 = '';

                    foreach ($data['where_did_you_know_school_'] as  $key => $val) {
                        if ($key == array_key_last($data['where_did_you_know_school_'])) {
                            $data1 .= '' . $val;
                        } else {
                            $data1 .= '' . $val . ', ';
                        }
                    }







                    $newStudentEnrollment = new StudentCourse();

                    $newStudentEnrollment->student_id = $user->id;

                    if (!empty($data1)) {
                        $newStudentEnrollment->where_did_you_know_school_ = $data1;
                    }

                    if (!empty($data['school_id'])) {
                        $newStudentEnrollment->school_id = $data['school_id'];
                    }

                    // if(!empty($data['branch_id'])){
                    //     $newStudentEnrollment->branch_id = $data['branch_id'];
                    // }else {
                    //     $newStudentEnrollment->branch_id="";
                    // }


                    if (!empty($data['school_course_id'])) {
                        $newStudentEnrollment->school_course_id = $data['school_course_id'];
                    }



                    if (!empty($data['driving_lto_requirement'])) {
                        $newStudentEnrollment->driving_lto_requirement = $data['driving_lto_requirement'];
                    }


                    if (!empty($data['theoretical_driving_course'])) {
                        $newStudentEnrollment->theoretical_driving_course = $data['theoretical_driving_course'];
                    }



                    if (!empty($data['practical_driving_course_mv'])) {
                        $newStudentEnrollment->practical_driving_course_mv = $data['practical_driving_course_mv'];
                    }

                    if (!empty($data['manual_transmission_mv'])) {
                        $newStudentEnrollment->manual_transmission_mv = $data['manual_transmission_mv'];
                    }


                    if (!empty($data['automatic_transmission_mv'])) {
                        $newStudentEnrollment->automatic_transmission_mv = $data['automatic_transmission_mv'];
                    }


                    if (!empty($data['practical_driving_course_mc'])) {
                        $newStudentEnrollment->practical_driving_course_mc = $data['practical_driving_course_mc'];
                    }

                    if (!empty($data['manual_transmission_mc'])) {
                        $newStudentEnrollment->manual_transmission_mc = $data['manual_transmission_mc'];
                    }


                    if (!empty($data['automatic_transmission_mc'])) {
                        $newStudentEnrollment->automatic_transmission_mc = $data['automatic_transmission_mc'];
                    }

                    if (!empty($data['automatic_transmission_mc'])) {
                        $newStudentEnrollment->others_mc = $data['others_mc'];
                    }


                    if (!empty($data1)) {
                        $newStudentEnrollment->where_did_you_know_school_ = $data1;
                    }




                    $is_save1 = $newStudentEnrollment->save();


                    if ($newStudentEnrollment) {
                        $newClass = new Classes();
                        $newClass->student_id = $user->id;
                        $newClass->school_id = $data['school_id'];
                        $newClass->course_id = $data['course_id'];
                        $is_save = $newClass->save();

                        if ($is_save) {

                            $id = $user->id;
                            $existUser = User::find($id);
                            $existUser->enrollment_status = 1;
                            $existUser->save();


                            $notification = new Notification();
                            // $notification->image_id = $imagemodel->id;
                            $notification->user_id = $user->id;
                            $notification->status = 'active';
                            $notification->type = 'message';
                            $notification->message = "You are successfully enrolled you can go to your theoretical for more info.";
                            $notification->save();

                            $user_notify = User::Where('id', '=', $user->id)->first();

                            $notification1 = new Notification();
                            // $notification->image_id = $imagemodel->id;
                            $notification1->user_id = $data['instructor_id'];
                            $notification1->status = 'active';
                            $notification1->type = 'message';
                            $notification1->message = "Student <strong>" . $user_notify->fname . ' ' . $user_notify->lname . "</strong> enrolled to your course";;
                            $notification1->save();

                            return  redirect()
                                ->back()
                                ->with('success', 'Congratualation!');
                        } else {
                            return  redirect()
                                ->back()
                                ->with('error', 'Failed to save data!!!');
                        }
                    }
                }
            }
        }
        $fname = $data['fname'];
        $lname = $data['lname'];
        $role = $data['role'];

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
        DB::commit();
        return $user;
    }
}
