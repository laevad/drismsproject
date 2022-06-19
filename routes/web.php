<?php

use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index');

Route::get('qrcode', 'QRController@generateQrCode');



// Route::get('storage/{filename}', function ($filename)
// {
//     $path = storage_path($filename);

//     if (!File::exists($path)) {
//         abort(404);
//     }

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     $response = Response::make($file, 200);
//     $response->header("Content-Type", $type);

//     return $response;
// });



// Route::get('qrcode', function () {
//     return QrCode::size(250)
//         ->backgroundColor(255, 255, 204)
//         ->generate('MyNotePaper');
// });

// Route::get('/register', 'HomeController@showRegistrationForm')->name('register');

Route::get('/student/register', 'HomeController@studentRegistration')->name('student.register');
Route::post('/student/registerStudent', 'HomeController@createStudent')->name('registerStudent');

Route::get('communication_test', 'CommunicationController@comm_test');
Route::post('communication_test/sms', 'CommunicationController@sms_test')->name('communication_test.sms');


Route::get('/contact-us', 'HomeController@contactUs')->name('contact-us');
Route::post('/sendmail', 'HomeController@sendEmail')->name('sendEmail');
Route::get('pages/profiles/{id}', 'ProfileController@show')->name('profiles.show');
Route::post('pages/profiles_update', 'ProfileController@store')->name('profiles.update');
Route::prefix('/course')->group(function () {
    Route::post('/store', 'CourseController@store')->name('course');
});
Route::get('invoice/print/{id}', 'InvoiceController@paymentPrint')->name('invoice.print');
Route::get('enrollment/form', 'EnrollmentController@enrollment')->name('enrollment.form');
Route::get('/school/addCourse/{id}', 'SchoolController@addCourse')->name('school.course.add');
Route::get('/school/editCourse/{id}', [SchoolController::class, 'show'])->name('school.course.edit');
Route::post('/school/updateCourse/{id}', [SchoolController::class, 'updateCourses'])->name('school.course.update');
Route::delete('/school/deleteCourse/{id}', [SchoolController::class, 'deleteCourses'])->name('school.course.delete');
Route::get('/school/reviewCourse/{id}', 'SchoolController@reviewCourse')->name('school.course.review');
Route::get('get/enrollment/branch/{id}', 'EnrollmentController@getEnrollmentBranch')->name('get.enrollment.branch');
Route::get('get/enrollment/{school_id}/course/{course_id}/', 'EnrollmentController@getEnrollmentCourse')->name('get.course');
Route::post('enrollment/', 'EnrollmentController@store')->name('enrollment.store');

Route::get('/student/scheduling/theoretical', 'StudentController@schedulinTheoretical')->name('student.scheduling.theoretical');

Route::get('/student/scheduling/practical', 'StudentController@schedulingPractical')->name('student.scheduling.practical');
Route::get('/student/scheduling/', 'StudentController@schedule')->name('student.scheduling');

Route::get('schedule/theoretical/', 'ScheduleController@theoretical')->name('schedule.theoretical');
Route::get('schedule/practical/', 'ScheduleController@practical')->name('schedule.practical');

Route::get('theoretical/instructor/view/student/{id}', 'ScheduleController@instructorTheoreticalViewStudent')->name('theoretical.instructor.view.student');
Route::put('theoretical/instructor/update/student/{id}', 'ScheduleController@instructorTheoreticalUpdateStudent')->name('theoretical.instructor.update.student');


Route::put('practical/instructor/update/student/{id}', 'ScheduleController@instructorPracticalUpdateStudent')->name('practical.instructor.update.student');

Route::get('{string}/instructor/{id_}/evaluation/{id}', 'InstructorController@instructorEvaluation')->name('instructor.evaluation');
Route::post('instructor/evaluation/store', 'InstructorController@instructorStoreEvaluation')->name('instructor.evaluation.store');



// Route::get('theoretical/instructor/{student_course_id}/evaluation/{instructor_id}', 'InstructorController@fleetInstructorEvaluation')->name('theoretical.instructor.evaluation');

Route::put('student/fleet/schedule/form/submit/{id}', 'FleetController@fleetStudentSchedule')->name('student.fleet.form.update');



Route::prefix('/admin')->group(function () {
    Route::get('/student/seach/', 'StudentController@search')->name('student-search');
    Route::get('/student/certification/{id}', 'DashboardController@certificate')->name('student.cert');
    Route::get('/instructor/evaluation/{id}', 'DashboardController@showInstructorEvaluation')->name('show.instructor.evaluation');
    Route::get('/instructor/seach/', 'InstructorController@search')->name('instructor-search');
    Route::get('/staff/seach/', 'StaffController@search')->name('staff-search');
    Route::post('/notify', 'NotificationController@notify');
    Route::post('/school/email', 'SchoolController@sendEmail')->name('school.email');
    Route::post('/branch/email', 'BranchController@sendEmail')->name('branch.email');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/school/sendSms/', 'SchoolController@sendSms')->name('school.sendSms');
    Route::post('/branch/sendSms/', 'BranchController@sendSms')->name('branch.sendSms');
    Route::post('school/courseSchoolStore', 'SchoolController@courseSchoolStore')->name('school.courseSchoolStore');
    Route::delete('school/scDelete/{id}', 'SchoolController@scDelete')->name('school.scDelete');
    Route::post('addPayment', 'InvoiceController@addPayment')->name('invoice.addPayment');
    Route::get('fleet/form/{id}', 'FleetController@showSchedule')->name('fleet.form.show');
    Route::post('fleet/form/store', 'FleetController@storeSchedule')->name('fleet.form.store');

    Route::get('instructor/fleet/schedule/form/edit/{id}', 'FleetController@editInstructorSchedule')->name('fleet.form.edit');
    Route::put('instructor/fleet/schedule/form/update/{id}', 'FleetController@updateInstructorSchedule')->name('fleet.form.update');
    Route::delete('instructor/fleet/schedule/form/delete/{id}', 'FleetController@destroyFleetSchedule')->name('fleet.form.delete');
});

Route::prefix('admin')->group(function () {
    // Route::resource('dashboard', 'DashboardController');
    Route::resource('schedule', 'ScheduleController');
    Route::resource('student', 'StudentController');
    Route::resource('instructor', 'InstructorController');
    Route::resource('fleet', 'FleetController');
    Route::resource('branch', 'BranchController');
    Route::resource('invoice', 'InvoiceController');
    Route::resource('staff', 'StaffController');
    Route::resource('course', 'CourseController');
    Route::resource('school', 'SchoolController');
    Route::resource('smsGateWay', 'SmsGateWayController');
});

Route::resource('dashboard', 'DashboardController');
Route::resource('settings', 'SettingController');
Route::resource('notification', 'NotificationController');
Route::resource('communication', 'CommunicationController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
