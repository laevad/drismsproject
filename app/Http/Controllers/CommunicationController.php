<?php

namespace App\Http\Controllers;

use App\Communication;

use App\User;
use App\Image;
use App\Communication_user_school_branch;

use App\SmsGateWay;

use App\Branch;
use App\School;

use Auth;


use App\Notification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class CommunicationController extends Controller
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

        $users =  User::where('id', '!=', auth()->id())->get();

        $receiver_users = User::join('communication_user_school_branches as cusb', 'users.id', '=', 'cusb.user_receiver_id')
            ->join('communications as c', 'c.id', '=', 'cusb.comm_id')
            ->leftJoin('images as i', 'users.id', '=', 'i.user_id')
            ->orderBy('cusb.created_at', 'DESC')->orderBy('c.created_at', 'desc')
            ->get(['users.*', 'cusb.*', 'cusb.id as cusb_id', 'c.*', 'i.name as image_name']);

        $branch_users = Branch::join('communication_user_school_branches as cusb', 'branches.id', '=', 'cusb.branch_receiver_id')
            ->join('communications as c', 'c.id', '=', 'cusb.comm_id')
            ->orderBy('cusb.created_at', 'DESC')->orderBy('c.created_at', 'desc')
            ->get(['branches.*', 'cusb.*', 'cusb.id as cusb_id', 'c.*']);

        $school_users = School::join('communication_user_school_branches as cusb', 'schools.id', '=', 'cusb.school_receiver_id')
            ->join('communications as c', 'c.id', '=', 'cusb.comm_id')
            ->orderBy('cusb.created_at', 'DESC')
            ->orderBy('c.created_at', 'desc')
            ->get(['schools.*', 'cusb.*', 'cusb.id as cusb_id', 'c.*']);




        return view('communication', compact('profile_pic', 'users', 'receiver_users', 'branch_users', 'school_users'));
    }



    public function comm_test()
    {

        return view('communication_test');
    }


    public function sms_test()
    {

        $apikey = '31d93f11';
        $to = '09675220070';
        $message = "Testing Sms";
        $mobile_ip = "http://192.168.1.7:8082/";


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $mobile_ip);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"to\":\"$to\",\"message\":\"$message\"}");

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: ' . $apikey
            )
        );

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // $apikey = '33856c4a';
        // $to = '09752623146';
        // $message = 'This is a test';
        // $mobile_ip = 'http://192.168.1.13:8082';

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $mobile_ip);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"to\":\"$to\",\"message\":\"$message\"}");
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json',
        //     'Authorization: ' . $apikey)
        // );

        // $result = curl_exec($ch);
        // if (curl_errno($ch)) {
        //     echo 'Error:' . curl_error($ch);
        // }
        // curl_close($ch);

    }

    /**
     * Maximum execution time of 60 seconds exceeded
     * Update php.ini in your xampp for the
     *
     * max_execution_time=1800
     * max_input_time=1200
     * memory_limit=5120M
     */
    public function subMessage($request, $data, $comm_id, $comm_reciever)
    {

        // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NTAxMzMxNCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1MDgyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.8UkHUDbGDsL0Fpdb21t5kwXxUOvyfByzdy8lHiNlZxg');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);


        $subject = $request->subject;

        $count = 0;
        foreach ($data as $key => $value) {

            $communication_user_school_branch = new Communication_user_school_branch();

            $communication_user_school_branch->user_sender_id = auth()->id();
            $communication_user_school_branch->$comm_reciever = $value->id;
            $communication_user_school_branch->comm_id = $comm_id;

            $communication_user_school_branch->save();




            // dd("Email is sent successfully.");
            $to_email = $value->email;
            $to_name = $value->fname;
            $data = array(
                'name' => "$to_name",
                'body' => $request->message,
                'subject' => $request->subject,
            );

            // print_r($data);
            $is_send = Mail::send(
                'emails.mail',
                $data,
                function ($message) use ($to_name, $to_email, $subject) {
                    $message->from(Auth::user()->email, "from " . Auth::user()->fname);
                    $message->to($to_email, $to_name)->subject($subject);
                }
            );






            $notification1 = new Notification();
            // $notification->image_id = $imagemodel->id;
            $notification1->user_id = $value->id;
            $notification1->status = 'active';
            $notification1->type = 'message';
            $notification1->message = "$request->message <br/><small>Type: $request->type </small><br/><small>Sender: " . Auth::user()->fname . ' ' . Auth::user()->lname . "</small> ";
            $notification1->save();
        }
        if ($request->type == 'sms') {

            $sendMessageRequest1 = new SendMessageRequest([
                'phoneNumber' => $value->phone,
                'message' => $request->message,
                'deviceId' => 128658
            ]);
            $sendMessages = $messageClient->sendMessages([
                $sendMessageRequest1
            ]);
            $notification1 = new Notification();
            // $notification->image_id = $imagemodel->id;
            $notification1->user_id = $value->id;
            $notification1->status = 'active';
            $notification1->type = 'message';
            $notification1->message = "$request->message <br/><small>Type: $request->type </small><br/><small>Sender: " . Auth::user()->fname . ' ' . Auth::user()->lname . "</small> ";
            $notification1->save();
        }
        return redirect()->back()->with('success', "Messsage Sent.");
    }

    public function messages($request, $condition = "", $condition_operation = "", $condition_ = "")
    {


        $communication = new Communication();
        $communication->type = $request->type;
        $communication->subject = $request->subject;
        $communication->messages =  $request->message;
        $communication->save();

        switch ($request->recipient) {
            case ('branches'):
                $branches = Branch::all();
                $this->subMessage($request, $branches, $communication->id, 'branch_receiver_id');
                break;
            case ('schools'):
                $schools = School::all();
                $this->subMessage($request, $schools, $communication->id, 'school_receiver_id');
                break;
            case ('everyone'):
                //   $schools = School::all();
                $branches = Branch::all();
                $this->subMessage($request, $branches, $communication->id, 'branch_receiver_id');
                $schools = School::all();
                $this->subMessage($request, $schools, $communication->id, 'school_receiver_id');
                $users = User::where($condition, $condition_operation, $condition_)->get();
                $this->subMessage($request, $users, $communication->id, 'user_receiver_id');
                break;
            default:
                $users = User::where($condition, $condition_operation, $condition_)->get();
                $this->subMessage($request, $users, $communication->id, 'user_receiver_id');
                break;
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



        // return;
        // var_dump($request->recipient);
        switch ($request->recipient) {
            case ('student'):
                $this->messages($request, 'role', '=', $request->recipient);
                break;
            case ('staff'):
                $this->messages($request, 'role', '=', $request->recipient);
                break;
            case ('instructor'):
                $this->messages($request, 'role', '=', $request->recipient);
                break;
            case ('branches'):
                $this->messages($request);
                break;
            case ('schools'):
                $this->messages($request);
                break;
            case ('everyone'):
                $this->messages($request, 'id', '!=',  auth()->id());
                break;
            default:
                $this->messages($request, 'id', '=', $request->recipient);
                break;
        }
        // return;
        // return redirect()->back()->with('success', 'Message has been sent');
        return redirect()->back()->with('success', "Messsage Sent.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function show(communication $communication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function edit(communication $communication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, communication $communication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existingCommunication_user_school_branch = Communication_user_school_branch::find($id);

        if ($existingCommunication_user_school_branch) {
            $existingCommunication_user_school_branch->delete();
            return  redirect()->back()->with('success', 'Message deleted successfully!');
        }
    }
}
