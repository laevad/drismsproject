<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\Image;
use Auth;
use App\SmsGateWay;

use Illuminate\Http\Request;



use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SettingController extends Controller
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

        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
            ->where('users.id', Auth::user()->id)
            ->get(['users.*', 'images.name as image_name']);

        $existSmsGateWay = SmsGateWay::where('user_id', '=', Auth::user()->id)->first();


        $qrcodes =  QrCode::size(50)
            ->backgroundColor(255, 255, 204)
            ->generate('facebook.com');


        $link = "https://codeanddeploy.com/category/laravel";



        return view('settings/settings', compact('profile_pic', 'existSmsGateWay', 'qrcodes', 'link'));
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $existingUser  = User::find($id);
        if ($existingUser) {
            if ($request->step == 'step 1') {
                $request->validate([
                    'fname' => 'required|string|max:255',
                    'lname' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'dob' => 'required|before:5 years ago',
                    'phone' => 'required|string|max:255',
                    'gender' => 'required|string',
                ]);

                $existingUser->fname = $request->fname;
                $existingUser->lname = $request->lname;
                $existingUser->address = $request->address;
                $existingUser->dob = $request->dob;
                $existingUser->phone = $request->phone;
                $existingUser->gender = $request->gender;
                $is_save = $existingUser->save();

                if (!empty($request->profile_image)) {

                    $image_ = Image::where('user_id', $id)->first();

                    if ($image_ == null) {

                        $image = $request->profile_image;
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = str_random(10) . '.png';
                        $is_store = Storage::disk('local')->put($imageName, base64_decode($image));
                        if ($is_store) {
                            $imageExist = new Image();
                            $imageExist->user_id = $id;
                            $imageExist->name = "$imageName";
                            $imageExist->save();
                        }
                    } else {
                        $unlink = unlink("./images/$image_->name");


                        $image = $request->profile_image;
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = str_random(10) . '.png';
                        $is_store = Storage::disk('local')->put($imageName, base64_decode($image));


                        if ($is_store) {
                            $imageExist = Image::find($image_->id);
                            $imageExist->name = "$imageName";
                            $imageExist->save();
                        }
                    }
                }

                if ($is_save) {
                    return redirect()->back()->with('success', 'Successfully update profile info!');
                } else {
                    return redirect()->back()->with('error', 'We encounter error updating your profile info!');
                }
            } else if ($request->step == 'step 2') {
                $request->validate([
                    'username' => 'required|string|max:255|unique:users|regex:/^\S*$/u',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:4|confirmed',
                ]);

                $existingUser->username = $request->username;
                $existingUser->email = $request->email;
                $existingUser->password = Hash::make($request->password);
                $is_save = $existingUser->save();


                if ($is_save) {
                    return redirect()->back()->with('success', 'Successfully update Account!');
                } else {
                    return redirect()->back()->with('error', 'We encounter error updating your Account!');
                }
            } else {
                return;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
