<?php

use App\Http\Controllers\Api\admin\CarsController;
use App\Http\Controllers\Api\admin\ClientsController;
use App\Http\Controllers\Api\admin\BookingsController;
use App\Http\Controllers\Api\admin\ContactController;
use App\Http\Controllers\Api\admin\DashboardController;
use App\Http\Controllers\Api\admin\NewslleterController;
use App\Http\Controllers\Api\admin\TransactionController;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\auth\ResetPasswordController;
use App\Http\Controllers\Api\auth\ForgotPasswordController;
use App\Http\Controllers\Api\auth\RegisteredUserController;
use App\Http\Controllers\Api\auth\AuthenticatedSessionController;
use App\Http\Controllers\BookinkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'middleware' => 'api',
    'prefix' => 'v0/auth'
], function ($router) {
    Route::post('/login', [AuthenticatedSessionController::class, 'login']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout']);
    Route::post('/refresh', [AuthenticatedSessionController::class, 'refresh']);
    Route::post('/register', [AuthenticatedSessionController::class, 'register']);
    Route::post('password/forgot-password', [ForgotPasswordController::class, 'sendResetLinkResponse'])->name('passwords.sent');
    Route::post('password/reset', [ResetPasswordController::class, 'sendResetResponse'])->name('passwords.reset');

});


/**
 * return admin dashbord route
 */
Route::group([
    'middleware' => 'api',
    'prefix' => 'v0'
], function ($router) { Route::middleware(['auth:api'])->group(function(){
    Route::apiResource('cars', CarsController::class);
    Route::apiResource('booking', BookingsController::class);
    Route::apiResource('transaction', TransactionController::class);
    Route::apiResource('newsletter', NewslleterController::class);
    Route::apiResource('contact', ContactController::class);
    Route::apiResource('dashboard', DashboardController::class);
     Route::apiResource('clientbooking',BookinkController::class);
    Route::apiResource('client', ClientsController::class);
    Route::get('/user-profile', [AuthenticatedSessionController::class, 'userProfile']);
    Route::put('/update-profile/{id}/', [AuthenticatedSessionController::class, 'update']);
    Route::put('/update-passord/{id}/', [AuthenticatedSessionController::class, 'changePassword']);
    Route::get('/send-email', [EmailController::class,'sendEmail']);

    });


});

