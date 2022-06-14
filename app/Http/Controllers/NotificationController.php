<?php

namespace App\Http\Controllers;

use App\Notification;

use App\User;
use App\Image;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
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

        $users = User::where([
                ['role', '=', 'Admin'],
                ['id', '=', Auth::user()->id]
            ])->first();
        $notifications=array();
        if($users){ 
            
            $notifications = Notification::join('users', 'users.id', '=', 'notifications.user_id') 
                ->leftJoin('images', 'images.id', '=', 'notifications.image_id') 
                ->orderBy('notifications.created_at', 'desc')
                ->get(['users.*', 'notifications.status as nstatus','notifications.*', 'images.name as image_name']);

        }else{
            $notifications = Notification::join('users', 'users.id', '=', 'notifications.user_id') 
            ->leftJoin('images', 'images.id', '=', 'notifications.image_id')
            ->where( 'users.id', Auth::user()->id) 
            ->orderBy('notifications.created_at', 'desc')
            ->get(['users.*', 'notifications.status as nstatus','notifications.*', 'images.name as image_name']);
        }
        
        return view('notifications', compact('profile_pic', 'notifications'));

    }


    public function notify(){
 
        // $admin_notify = User::where('role', 'Admin')->first();



        $admin_notify = User::where([
            ['role', '=', 'Admin'],
            ['id', '=', Auth::user()->id]
        ])->first();

        $notifications=array();
        if($admin_notify){
            $notification = Notification::join('users as u', 'u.id', '=', 'notifications.user_id')
                ->where(
                [  
                    ['notifications.type', 'payment'],
                    ['notifications.status', 'active']
                ])
                ->orWhere([ 
                    ['notifications.type', 'message'],
                    ['notifications.type', 'active']
                ])
                ->orWhere([ 
                    ['notifications.type', 'delete'],
                    ['notifications.status', 'active']
                ])
                ->orWhere([ 
                    ['notifications.type', 'calendar'],
                    ['notifications.status', 'active']
                ])->count();


        }else{
            $notification = Notification::where(
            [ 
                ['user_id', Auth::user()->id],
                ['type', 'payment'],
                ['status', 'active']
            ])
            ->orWhere([
                ['user_id', Auth::user()->id],
                ['type', 'message'],
                ['status', 'active']
            ])
            ->orWhere([
                ['user_id', Auth::user()->id],
                ['type', 'delete'],
                ['status', 'active']
            ])
            ->orWhere([
                ['user_id', Auth::user()->id],
                ['type', 'calendar'],
                ['status', 'active']
            ])->count();
        }
        
                        

        return response()->json(['notifify'=>$notification]);
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
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    { 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $notification = Notification::where('id', $id)->update(array('status' => 'not active'));
        $status = false;
        if($notification ){
            $status= true;
        }
        return $status; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $exists = Notification::find($id);

        if($exists){ 
            $exists->delete();   
            return  redirect()->back()->with('success', 'Deleted notification successfully!'); 
        }
    }
}
