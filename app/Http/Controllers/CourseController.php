<?php

namespace App\Http\Controllers;

use App\Course;
use App\Image;
use App\User;
use Auth; 
use App\Permission;

use App\Notification;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File; 
 

class CourseController extends Controller
{

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
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
         

        $courses = Course::leftJoin('images', 'courses.id', '=', 'images.course_id')
        ->orderBy('created_at', 'DESC')
        ->get(['courses.*', 'images.name as image_name']);

        $users = User::where('role', 'Instructor')
        ->orderBy('created_at', 'DESC')->get();
        //$courses = Course::with('image.course')->orderBy('created_at', 'DESC')->get();
         

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


        return view('admin/course', compact('courses', 'users', 'profile_pic', 'permission_status', 'permission_delete'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->image_course;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10) . '.png';
        Storage::disk('local')->put($imageName, base64_decode($image));

        $newCourse= new Course();  

        $newCourse->name=$request->input('name');
        $newCourse->price=intval($request->input('price'));
        // $newCourse->duration=$request->input('duration');
        // $newCourse->period=$request->input('period');
        // $newCourse->practical_classes=intval($request->input('practical_classes'));
        // $newCourse->theory_classes=intval($request->input('theory_classes'));
        $newCourse->status=$request->input('status');
        $newCourse->save();
 
        $imagemodel= new Image();
        $imagemodel->name="$imageName";
        $imagemodel->course_id = $newCourse->id;
        $is_saved = $imagemodel->save();
 
        if ($is_saved) { 
            return redirect()->back()->with('success', 'successfully save data!');   
        }else{ 
            return redirect()->back()->with('error', 'Failed to save data');    
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $course = Course::where('id', '=', $id)->first();    
        return $course; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingCourse  = Course::find($id);
        if($existingCourse){  

            $existingCourse->name=$request->name;
            $existingCourse->price=intval($request->price);
            // $existingCourse->duration=$request->duration;
            // $existingCourse->period=$request->period;
            // $existingCourse->practical_classes=intval($request->practical_classes);
            // $existingCourse->theory_classes=intval($request->theory_classes);
            $existingCourse->status=$request->status;

            $is_save = $existingCourse->save(); 

            if(!empty($request->image_course)){ 

                $image_ = Image::where('course_id', $id)->first();
                
                if($image_ == null){

                    $image = $request->image_course;
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = str_random(10) . '.png';
                    $is_store = Storage::disk('local')->put($imageName, base64_decode($image));
                    if($is_store){ 
                        $imageExist= new Image();
                        $imageExist->course_id = $id;
                        $imageExist->name="$imageName"; 
                        $imageExist->save();
                    }
                }else{
                    
                    $unlink = unlink("./images/$image_->name");
                
                    $image = $request->image_course;
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = str_random(10) . '.png';
                    $is_store = Storage::disk('local')->put($imageName, base64_decode($image));
                    
                    if($is_store){ 
                        $imageExist= Image::find($image_->id);
                        $imageExist->name="$imageName"; 
                        $imageExist->save();
                    }
                }
            }else{ 
                if($is_save){
                    return redirect()->back()->with('success', 'Successfully update the course!');
                }else{
                    return redirect()->back()->with('error', 'Failed to update the course!');
                } 
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existingCourse = Course::find( $id );

        if( $existingCourse )
        {
            $image_ = Image::where('course_id', $id)->first(); 
            $unlink = unlink("/.images/$image_->name");
            $image_->delete();  
            $existingCourse->delete();  

            
            $notification1 = new Notification();
            // $notification->image_id = $imagemodel->id;
            $notification1->user_id = Auth::user()->id;
            $notification1->status = 'active';
            $notification1->type = 'delete';
            $notification1->message = "Course ( $existingCourse->name ) has been deleted by: " . Auth::user()->fname . ' '. Auth::user()->lname. "</strong> ";
            $notification1->save();


            return  redirect()->back()->with('success', 'Course deleted successfully!');
        } 
        return redirect()->back()->with('error', 'Sorry, we have trouble to delete data from Course');
 
    }
}
