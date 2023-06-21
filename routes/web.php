<?php

use Illuminate\Support\Facades\Route;

use Twilio\Rest\Client;


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
Route::get('/intro','LandingpageController@index');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/install/check-db', 'HomeController@checkConnectDatabase');

// Social Login
Route::get('social-login/{provider}', 'Auth\LoginController@socialLogin');
Route::get('social-callback/{provider}', 'Auth\LoginController@socialCallBack');

// Logs
Route::get(config('admin.admin_route_prefix').'/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth', 'dashboard','system_log_view'])->name('admin.logs');

Route::get('/install','InstallerController@redirectToRequirement')->name('LaravelInstaller::welcome');
Route::get('/install/environment','InstallerController@redirectToWizard')->name('LaravelInstaller::environment');
Route::get('/booking/cancel/{id}', 'BookingController@cancel')->name('booking.cancel');

Route::get('/sms', function () {
           // Send Twillio Message on whats app

           $sid    = getenv("TWILIO_AUTH_SID");

           $token  = getenv("TWILIO_AUTH_TOKEN");
   
           $wa_from= getenv("TWILIO_WHATSAPP_FROM");
   
           $twilio = new Client($sid, $token);

           
           $msgBody = "You Booking Updated\nBooking id: 250\nService:NANA SHRI GUEST HOUSE";
   
           $message = $twilio->messages
                     ->create("whatsapp:+919814274641", // to
                              [
                                  "body" => $msgBody,
                                  "from" => "whatsapp:$wa_from",
                              ]
                     );
   
           print($message);
});
