<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CustomAuth\CustomAuthController;
use App\Http\Controllers\PaymentController;
use League\Flysystem\Filesystem;
use Obs\ObsClient;
use Zing\Flysystem\Obs\ObsAdapter;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('fff', function(){

    return view('file');
});

route::post('/ttt', function(Request $request){
    $prefix = '';
    $config = [
        'key' => '7NBPYLX5IMJMXEVUAMJR',
        'secret' => 'k8PDyRPK94ZXjtoZExxCqqEXD8HI4jN63qCtJW0Z',
        'bucket' => 'biddabari-bucket',
        'endpoint' => 'obs.as-south-208.rcloud.reddotdigitalit.com',
    ];
    
    $config['options'] = [
        'url' => '',
        'endpoint' => $config['endpoint'], 
        'bucket_endpoint' => 'https://biddabari-bucket.obs.as-south-208.rcloud.reddotdigitalit.com',
        'temporary_url' => '',
    ];
    
    $client = new ObsClient($config);
    $adapter = new ObsAdapter($client, $config['bucket'], $prefix, null, null, $config['options']);
    $flysystem = new Filesystem($adapter);

    $file = $request->file('file');
    $filePath = $file->getRealPath();
    $fileName = 'backend/assets/uploaded-files/'.$file->getClientOriginalName();
    $result = $client->putObject([
    'Bucket' => env('OBS_BUCKET'),
    'Key' => $fileName,
    'SourceFile' => $filePath,
    ]);
    return response()->json(['url' => $result['ObjectURL']]);


});

Route::post('/register', [CustomAuthController::class, 'register'])->name('register');
Route::post('/login', [CustomAuthController::class, 'login'])->name('login');
Route::get('/login', function (){
    return view('backend.auth.admin-login');
})->name('custom-login');
Route::get('/register-page', function (){
    return view('backend.auth.admin-register');
})->name('custom-register');
Route::get('/forgot-user-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot-user-password');
Route::post('/send-password-reset-otp', [CustomAuthController::class, 'passResetOtp'])->name('send-password-reset-otp');
Route::get('/password-reset-otp', [CustomAuthController::class, 'passwordResetOtp'])->name('password-reset-otp');
Route::post('/verify-pass-reset-otp', [CustomAuthController::class, 'verifyPassResetOtp'])->name('verify-pass-reset-otp');


//Route::post('sslcommerz/success',[PaymentController::class, 'success'])->name('payment.success');
//Route::post('sslcommerz/failure',[PaymentController::class, 'failure'])->name('payment.failure');
//Route::post('sslcommerz/cancel',[PaymentController::class, 'cancel'])->name('payment.cancel');
//Route::post('sslcommerz/ipn',[PaymentController::class, 'ipn'])->name('payment.ipn');

Route::get('form',[PaymentController::class, 'form'])->name('form');
Route::post('form-order',[PaymentController::class, 'order'])->name('form-order');


/**
 * @return void
 */

/* clear all cache */
Route::get('/clear-all', function () {
    Artisan::call('optimize:clear');
    echo Artisan::output();
});
Route::get('/clear-all-cache', function () {
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'Cache cleared successfully' );
})->name('clear-all-cache');
//example one
Route::get('/a', function () {
    shell_exec('convert '. public_path('backend/assets/uploaded-files/course-xm-temp-file-upload/tmp--1711188856692.jpg').' '.public_path('backend/assets/uploaded-files/course-xm-temp-file-upload/tmp-1709199042765.jpg').' '.public_path('backend/assets/uploaded-files/course-written-xm-ans-files/dd.pdf'));
//   shell_exec('php artisan make:model A');
   echo 'a';
});
/* migration */
Route::get('/migrate',function(){
    Artisan::call('migrate');
    echo Artisan::output();
});

Route::get('/migrate-seed',function(){
    Artisan::call('migrate --seed');
    echo Artisan::output();
});

Route::get('/migrate-fresh-seed',function(){
    Artisan::call('migrate:fresh --seed');
    echo Artisan::output();
});

/* migration rollback */
Route::get('/migrate-rollback',function(){
    Artisan::call('migrate:rollback');
    echo Artisan::output();
});

/* create symbolic link */
Route::get('/symlink', function () {
    Artisan::call('storage:link');
    echo Artisan::output();
});
/* Optimize files */
Route::get('/optimize', function () {
    Artisan::call('optimize');
    echo Artisan::output();
});
/* clear view cache */
Route::get('/clear-view-cache', function () {
    Artisan::call('view:clear');
    return 'View Cache Cleared';
});
/* clear route cache */
Route::get('/clear-route-cache', function () {
    Artisan::call('route:clear');
    return 'Route Cache Cleared';
});
/* Only db seed */
Route::get('/only-db-seed', function () {
    Artisan::call('db:seed');
    return 'DB Seed successful';
});

Route::get('/phpinfo', function () {
    phpinfo();
});



