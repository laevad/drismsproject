<?php

namespace App\Http\Controllers;

use App\SmsGateWay;
use Illuminate\Http\Request;
use Auth;

class SmsGateWayController extends Controller
{

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        $existSmsGateWay = SmsGateWay::where('user_id', '=', Auth::user()->id)->first();
        
        if(!$existSmsGateWay){ 
            $smsGateway = new SmsGateWay();
            $smsGateway->user_id = Auth::user()->id;
            $smsGateway->api_key = $request->api_key;
            $smsGateway->mobile_ip =  $request->mobile_ip;
            $is_save = $smsGateway->save(); 
            if( $is_save )
                return redirect()->back()->with('success', 'Successfully save your traccar API key and Local IP'); 
            else 
                return redirect()->back()->with('error', 'We encounterd error to configure your sms gateway!');
        }else{
            return redirect()->back()->with('error', 'Please update your sms gateway!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SmsGateWay  $smsGateWay
     * @return \Illuminate\Http\Response
     */
    public function show(SmsGateWay $smsGateWay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SmsGateWay  $smsGateWay
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsGateWay $smsGateWay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SmsGateWay  $smsGateWay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // 

        $existSmsGateWay = SmsGateWay::where('user_id', '=', Auth::user()->id)->first();
        if($existSmsGateWay){
             
            $existSmsGateWay->api_key = $request->api_key;
            $existSmsGateWay->mobile_ip =  $request->mobile_ip;
            $is_save = $existSmsGateWay->save();
            
            if( $is_save )
                return redirect()->back()->with('success', 'Successfully update your traccar API key and Local IP'); 
            else 
                return redirect()->back()->with('error', 'We encounterd error to configure your sms gateway!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SmsGateWay  $smsGateWay
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsGateWay $smsGateWay)
    {
        //
    }
}
