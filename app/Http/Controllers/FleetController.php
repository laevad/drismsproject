<?php

namespace App\Http\Controllers;

use App\Fleet;
use App\SchoolCourse;
use App\User;
use App\Image;
use App\FleetSchedule;
use Auth;
use App\Permission;

use App\Notification;

use Illuminate\Http\Request;

class FleetController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

        $users = User::orderBy('created_at', 'DESC')
            ->where('role', 'Instructor')
            ->get();

        $fleet = Fleet::orderBy('created_at', 'DESC')->get();


        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first();
        $permission_status = "";

        if ($permission) {
            if ($permission->fleet == "read_only") {
                $permission_status = "disabled";
            }
        }

        return view('admin/fleet', compact('users', 'fleet', 'profile_pic', 'permission_status'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = '';
        $scs = SchoolCourse::all();
        $fleet = new Fleet();
        $fleet->car_no = $request->carno;
        $fleet->car_plate = $request->carplate;
        $fleet->make = $request->make;
        $fleet->model = $request->model;
        $fleet->model_year = $request->modelyear;
        // $fleet->instructor_id = $request->instructor;

        $is_save = $fleet->save();
        if ($is_save) {
            return redirect()
                ->back()
                ->with('success', 'New fleet record saved!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Failed to save data!!!');
        }

    }

    public function showSchedule($id)
    {

        $fleet = Fleet::where('id', $id)->first();

        $instructors = User::where('role', '=', 'Instructor')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin/form/addFleet', compact('instructors', 'fleet'))->with('id', $id);
    }

    public function storeSchedule(Request $request)
    {
        if (strtotime($request->time_start) > strtotime($request->time_end)) {
            return redirect()
                ->back()
                ->with('error', 'time end must higher than time start .');
        }
        $data = '';
//            foreach($request->day as $key => $val){
//                if($key == array_key_last($request->day)){
//                    $data .= '' . $val;
//                }else{
//                    $data .= '' . $val . ', ';
//                }
//            }
        $scs = FleetSchedule::all();
        if ($scs->isEmpty()) {
            foreach ($request->day as $key => $val) {
                if ($key == array_key_last($request->day)) {
                    $data .= '' . $val;
                } else {
                    $data .= '' . $val . ', ';
                }
            }
        }
        $status = false;
        $status1 = false;
        $days = FleetSchedule::select("day")->where("instructor_id", "=", $request->instructor_id)->get();
        foreach ($scs as $sc) {
            if ($sc->instructor_id == $request->instructor_id) {
                $status1 = true;
            }
        }
        if ($status1) {
            foreach ($request->day as $key => $val) {
                if ($key == array_key_last($request->day)) {
                    $data .= '' . $val;
                } else {
                    $data .= '' . $val . ', ';
                }
            }
            foreach ($days as $dd){
                foreach (explode(', ', $dd->day) as $day) {
                    foreach($request->day as $key => $val){
                        if ($val == $day){
                            if(strtotime($request->time_start) >= strtotime($sc->time_start) && strtotime($request->time_start) <= strtotime($sc->time_end)  ){
                                $status=true;
                            }
                            if(strtotime($request->time_end) >= strtotime($sc->time_start) && strtotime($request->time_end) <= strtotime($sc->time_end)  ){
                                $status=true;
                            }
                        }

                    }
                }
            }
        }
//            echo $request->time_start;
//            echo "<br>";
//            echo $sc->time_start;
//            dd(strtotime($request->time_start) >= strtotime($sc->time_start) || strtotime($request->time_end) <= strtotime($sc->time_end) );
//            dd($status);
        if ($status) {
            return redirect()
                ->back()
                ->with('error', 'time already exists.');
        } else {
            $exist = FleetSchedule::where([
                ['instructor_id', '=', $request->instructor_id],
                ['time_start', '=', $request->time_start],
                ['time_end', '=', $request->time_end],
            ])->first();
            if ($exist) {
                return redirect()->back()->with('exists', 'Time and instructor is already exists please go to the fleet schedule and you can just update if you want to add something.');
            } else {


                $newFleetSchedule = new FleetSchedule();
                $newFleetSchedule->fleet_id = $request->fleet_id;
                $newFleetSchedule->instructor_id = $request->instructor_id;
                $newFleetSchedule->time_start = $request->time_start;
                $newFleetSchedule->time_end = $request->time_end;
                $newFleetSchedule->day = $data;
                $newFleetSchedule->start = $request->start;
                $newFleetSchedule->end = $request->end;
                $newFleetSchedule->duration = $request->duration;
                $newFleetSchedule->period = $request->period;
                $is_save = $newFleetSchedule->save();

                if ($is_save) {

                    // $user = User::Where('id', '=', Auth::user()->id)->first();


                    // $notification = new Notification();
                    // // $notification->image_id = $imagemodel->id;
                    // // $notification->user_id = $notification_user_id;
                    // $notification->status = 'active';
                    // $notification->type = 'newaccount';
                    // $notification->message = "New Fleet Schedule added for <strong>" . $user->fname . ' ' . $user->lname . "</strong>.";
                    // $notification->save();

                    $notification1 = new Notification();
                    // $notification->image_id = $imagemodel->id;
                    $notification1->user_id = $request->instructor_id;
                    $notification1->status = 'active';
                    $notification1->type = 'message';
                    $notification1->message = "New practical course has been added";;
                    $notification1->save();
                    return redirect()->back()->with('success', 'Successfully added schedule.');
                } else {
                    return redirect()->back()->with('success', 'Error added schedule.');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Fleet $fleet
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function editInstructorSchedule($id)
    {


        //$fleet = FleetSchedule::find($id);

        $fleet = FleetSchedule::join('users as u', 'u.id', '=', 'fleet_schedules.instructor_id')
            ->join('fleet as f', 'f.id', '=', 'fleet_schedules.fleet_id')
            ->where('fleet_schedules.id', '=', $id)
            ->first(['f.*', 'u.fname as fname', 'u.lname as lname', 'fleet_schedules.*']);


        return view('admin/modified/instructorFleetSchedule', compact('fleet'))->with('id', $id);


    }

    public function updateInstructorSchedule(Request $request, $id)
    {


        $fleetExists = FleetSchedule::find($id);

        $data = '';
        foreach ($request->day as $key => $val) {
            if ($key == array_key_last($request->day)) {
                $data .= '' . $val;
            } else {
                $data .= '' . $val . ', ';
            }
        }

        if ($fleetExists) {

            $fleetExists->time_start = $request->time_start;
            $fleetExists->time_end = $request->time_end;
            $fleetExists->day = $data;
            $fleetExists->start = $request->start;
            $fleetExists->end = $request->end;
            $fleetExists->duration = $request->duration;
            $fleetExists->period = $request->period;
            $is_save = $fleetExists->save();

            if ($is_save) {
                return redirect()
                    ->back()
                    ->with('success', 'Update instructor fleet schedule.');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to update instructor fleet schedule!');
            }
        } else {
            return redirect()
                ->back()
                ->with('not_exists', "Instructor doesn't exists!");

        }
    }


    public function show($id)
    {

        $fleets = Fleet::leftJoin('fleet_schedules as fs', 'fs.fleet_id', '=', "fleet.id")
            ->join('users as s', 's.id', '=', 'fs.instructor_id')
            ->where('fleet.id', '=', $id)
            ->orderBy('fs.created_at', 'desc')
            ->get(['fleet.*', 's.fname as fname', 's.lname as lname', 'fs.*']);
        $fleet_single = Fleet::where('id', '=', $id)->first();

        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first();
        $permission_status = "";

        if ($permission) {
            if ($permission->fleet == "read_only") {
                $permission_status = "disabled";
            }
        }

        return view('admin/review/reviewFleetSchedule', compact('fleets', 'fleet_single'));
    }


    public function fleetStudentSchedule(Request $request, $id)
    {


        $exists = FleetSchedule::find($id);
        if ($exists) {
            $exists->student_id = $request->_student_id;
            $user = User::find($request->_student_id);
//            dd($user);
            $user->enrollment_status = 1;
            $is_save = $exists->save();
            if ($is_save) {
                $user->save();
                $notification = new Notification();
                // $notification->image_id = $imagemodel->id;
                $notification->user_id = Auth::user()->id;
                $notification->status = 'active';
                $notification->type = 'message';
                $notification->message = "You are successfully enrolled for Practical, you can go to your Dashboard Practical for more info.";
                $notification->save();


                $notification = new Notification();
                // $notification->image_id = $imagemodel->id;
                $notification->user_id = $exists->instructor_id;
                $notification->status = 'active';
                $notification->type = 'message';
                $notification->message = "You have new student for practical schedule";
                $notification->save();


                return redirect()->back()->with('success', 'Thanks for the practical registration!');

            } else {
                return redirect()->back()->with('error', 'Something went wrong!!!');

            }

        }

    }

    public function destroyFleetSchedule($id)
    {

        $fleetExists = FleetSchedule::find($id);

        if ($fleetExists) {
            $fleetExists->delete();
            return redirect()->back()->with('success', 'Fleet Schedule deleted successfully!');
        }
        return redirect()->back()->with('error', 'Sorry, we have trouble to delete data from branch');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Fleet $fleet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingFleet = Fleet::find($id);
        if ($existingFleet) {
            $existingFleet->car_no = $request->carno;
            $existingFleet->car_plate = $request->carplate;
            $existingFleet->make = $request->make;
            $existingFleet->model = $request->model;
            $existingFleet->model_year = $request->modelyear;
            $existingFleet->instructor_id = $request->instructor;

            $is_save = $existingFleet->save();

            if ($is_save) {
                return redirect()
                    ->back()
                    ->with('success', 'New fleet record saved!');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to save data!!!');
            }
        }
        return redirect()->back()->with('error', 'Sorry, we have trouble to update the fleet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Fleet $fleet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existingFleet = Fleet::find($id);

        if ($existingFleet) {
            $existingFleet->delete();


            $notification1 = new Notification();
            // $notification->image_id = $imagemodel->id;
            $notification1->user_id = Auth::user()->id;
            $notification1->status = 'active';
            $notification1->type = 'delete';
            $notification1->message = "Fleet (" . $existingFleet->make . " " . $existingFleet->model . ") has been deleted by: " . Auth::user()->fname . ' ' . Auth::user()->lname . "</strong> ";
            $notification1->save();


            return redirect()->back()->with('success', 'Fleet deleted successfully!');
        }
        return redirect()->back()->with('error', 'Sorry, we have trouble to delete this fleet.');

    }
}
