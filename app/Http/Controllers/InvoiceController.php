<?php

namespace App\Http\Controllers;

use App\Invoice;

use App\User;
use App\Image;

use App\Course;
use DB;
use Auth;

use App\Notification;
use App\Permission;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        //dd($invoiceAmount[0]->total_amount);


        // $invoiceAmount = Invoice::join('courses as c', 'c.id', '=', 'invoices.course_id')
        //                 ->where('invoices.user_id', 14)
        //                 ->get(['c.*', DB::raw('SUM(invoices.amount) as total_amount')]);
            // $winners = DB::table('invoices')
            // ->select('*', DB::raw("SUM(invoices.amount) as total_amount"))
            // ->leftJoin('courses', 'courses.id', '=', 'invoices.course_id')
            // ->groupBy('invoices.user_id');

        // $invoices = Invoice::leftJoin('users as u', 'u.id', '=', 'invoices.user_id')
        //                 ->leftJoin('courses as c', 'c.id', '=', 'invoices.course_id')
        //                 ->join('images as i', 'i.id', '=', 'u.id')
        //                 ->get(['u.*', 'i.name as image_name', 'c.*']);



    // $invoices = DB::table('invoices')
    //             ->select('*', 'courses.*', 'courses.name as course_name', 'i.name as image_name', DB::raw('SUM(invoices.amount) As total_amount'))
    //             ->join('courses', 'courses.id', '=', 'invoices.course_id')
    //             ->join('users as u', 'u.id', '=', 'invoices.user_id')
    //             ->join('images as i', 'i.id', '=', 'u.id')
    //             ->groupBy('invoices.user_id')
    //             ->get();


        $invoices = DB::table('invoices')
                    ->select('*', 'invoices.user_id as user_id', 'invoices.course_id as course_id',  'courses.*', 'courses.name as course_name' , 'i.name as image_name' , DB::raw('SUM(invoices.amount) As total_amount'))
                    ->join('courses', 'courses.id', '=', 'invoices.course_id')
                    ->join('users as u', 'u.id', '=', 'invoices.user_id')
                    ->leftJoin('images as i', 'i.id', '=', 'u.id')
                    ->groupBy('invoices.user_id')
                    ->groupBy('invoices.course_id')->orderBy('invoices.created_at', 'desc')
                    ->get();




        $profile_pic = User::join('images', 'users.id', '=', 'images.user_id')
        ->where('users.id', Auth::user()->id)
        ->get(['users.*', 'images.name as image_name']);

        $permission = Permission::where('staff_id', '=', Auth::user()->id)->first();

        $permission_status = "";
        if($permission) {
            if($permission->invoice == "read_only") {
                $permission_status = "disabled";
            }
        }



        return view('admin/invoice', compact('profile_pic', 'invoices', 'permission_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $invoiceAmount = Invoice::where('user_id', $request->student_id)->sum('amount');
        $courseAmount = Course::leftJoin('invoices as i', 'i.course_id', '=', 'courses.id')
                                ->first(['courses.price']);

        $total =  intval($courseAmount->price) - intval($invoiceAmount);


        if($invoiceAmount > $courseAmount->price || $total > $courseAmount->price || $request->amount > $courseAmount->price){
            return redirect()->back()->with('error', 'Failed to add payment.');
        }else{

            $newInvoice = new Invoice();
            $newInvoice->user_id = $request->student_id;
            $newInvoice->course_id = $request->course_id;
            $newInvoice->amount = $request->amount;
            $newInvoice->method = $request->method;
            $is_save = $newInvoice->save();

            if($is_save){

                $user = User::Where('id', '=', $request->student_id)->first();
                $notification = new Notification();
                // $notification->image_id = $imagemodel->id;
                $notification->user_id = $request->student_id;
                $notification->status = 'active';
                $notification->type = 'payment';
                $notification->message = "We've received your $notification->type ($request->amount) Pesos <strong>" . $user->fname . ' '. $user->lname. "</strong>.";
                $notification->save();

                return redirect()->back()->with('success', 'successfully add payment.');
            }else{
                return redirect()->back()->with('error', 'Failed to add payment.');
            }
        }
    }

    public function addPayment(Request $request){

        $newInvoice = new Invoice();
        $newInvoice->user_id = $request->student_id;
        $newInvoice->course_id = $request->course_id;
        $newInvoice->amount = $request->amount;
        $newInvoice->method = $request->method;
        $is_save = $newInvoice->save();

        if($is_save){

            $user = User::Where('id', '=', $request->student_id)->first();
            $notification = new Notification();
            // $notification->image_id = $imagemodel->id;
            $notification->user_id = $request->student_id;
            $notification->status = 'active';
            $notification->type = 'payment';
            $notification->message = "We've update your $notification->type ($request->amount) Pesos <strong>  $user->fname $user->lname </strong>.";
            $notification->save();


            return redirect()->back()->with('success', 'successfully add payment.');
        }else{
            return redirect()->back()->with('error', 'Failed to add payment.');
        }
    }

    public function paymentPrint($id){



    $invoices = DB::table('invoices')
            ->select('*', 'invoices.user_id as user_id', 'invoices.course_id as course_id',  'courses.*', 'courses.name as course_name' , 'i.name as image_name' , DB::raw('SUM(invoices.amount) As total_amount'))
            ->join('courses', 'courses.id', '=', 'invoices.course_id')
            ->join('users as u', 'u.id', '=', 'invoices.user_id')
            ->leftJoin('images as i', 'i.id', '=', 'u.id')
            ->groupBy('invoices.user_id')
            ->groupBy('invoices.course_id')
            ->where('invoices.user_id', '=', $id)
            ->get();


        return view('print/payment', compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
