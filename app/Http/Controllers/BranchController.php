<?php

namespace App\Http\Controllers;

use App\Branch;
use App\School;

use App\User;
use App\Image;
use Auth;

use App\Permission;

use App\Communication;
use App\Communication_user_school_branch; 

use App\SmsGateWay;


use App\Notification;

use Illuminate\Http\Request;
 
class BranchController extends Controller
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

        $branches = Branch::orderBy('created_at', 'DESC')->get();
        $schools = School::orderBy('created_at', 'DESC')->get();


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


        return view('admin/branch', compact('branches', 'profile_pic', 'schools', 'permission_status', 'permission_delete'));
    } 

    /**
     * Send Email in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function sendEmail(Request $request){
  
        $school_ = Branch::where('id', '=', $request->branch_id)->first();
         
        $communication = new Communication();
        $communication->type = 'email'; 
        $communication->suject = $request->subject; 
        $communication->messages =  $request->message;  
        $communication->save();

        $communication_user_school_branch = new Communication_user_school_branch();
        $communication_user_school_branch->user_sender_id = auth()->id();
        $communication_user_school_branch->branch_receiver_id = $request->school_id;
        $communication_user_school_branch->comm_id =$communication->id;
    
        $communication_user_school_branch->save();
  
        $to_name = $school_->name;
        $to_email = $school_->email;
        $subject = $request->subject;

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



    public function sendSms(Request $request){
  
        $branch_ = Branch::where('id', '=', $request->branch_id)->first();
         
        $communication = new Communication();
        $communication->type = 'sms'; 
        $communication->messages =  $request->message;  
        $communication->save();

        $communication_user_school_branch = new Communication_user_school_branch();
        $communication_user_school_branch->user_sender_id = auth()->id();
        $communication_user_school_branch->branch_receiver_id = $request->branch_id;
        $communication_user_school_branch->comm_id =$communication->id;
    
        $communication_user_school_branch->save();


        $existSmsGateWay = SmsGateWay::where('user_id', '=', Auth::user()->id)->first();

        if($existSmsGateWay){  
            $apikey = "$existSmsGateWay->api_key"; 
            $to = $branch_->phone; 
            $message = $request->message;
            $mobile_ip = "$existSmsGateWay->mobile_ip"; 
    
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
                return redirect()->back()->with('error', "We have error to send your message " . curl_error($ch) . "!");
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
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:branches',
            'phone' => 'required',
            'address' => 'required',
            'school_id' => 'required' 
        ]);

        $branch = new Branch(); 
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->school_id = $request->school_id;
        $is_save = $branch->save();

        if($is_save){
            return  redirect()
                ->back()
                ->with('success', 'New branch record saved!');
        }else{
            return  redirect()
                ->back()
                ->with('error', 'Failed to save data!!!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required',
            'address' => 'required' 
        ]);

        $existingBranch = Branch::find($id);

        if($existingBranch){ 
            $existingBranch->name = $request->name;
            $existingBranch->email = $request->email;
            $existingBranch->phone = $request->phone;
            $existingBranch->address = $request->address;

            $is_save = $existingBranch->save();
            if($is_save){
                return  redirect()
                    ->back()
                    ->with('success', 'Update branch record saved!');
            }else{
                return  redirect()
                    ->back()
                    ->with('error', 'Failed to update data!!!');
            }
        } 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {  
        
        $existingBranch = Branch::find( $id );

        if( $existingBranch )
        {
            $existingBranch->delete();  
 
            $notification1 = new Notification();
            // $notification->image_id = $imagemodel->id;
            $notification1->user_id = Auth::user()->id;
            $notification1->status = 'active';
            $notification1->type = 'delete';
            $notification1->message = "Branch ( $existingBranch->name ) has been deleted by: " . Auth::user()->fname . ' '. Auth::user()->lname. "</strong> ";
            $notification1->save();
         

            return  redirect()->back()->with('success', 'Branch deleted successfully!');
        } 
        return redirect()->back()->with('error', 'Sorry, we have trouble to delete data from branch');
 
    }
}
