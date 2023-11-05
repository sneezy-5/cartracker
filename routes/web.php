<?php

use App\Http\Controllers\BookinkController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Models\Cars;
use App\Models\Contact;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    $cars = Cars::paginate(5);
    return view('welcome', compact("cars"));
});

Route::get('/about', function () {
    return view('page.about');
})->name('about');

Route::get('/services', function () {
    return view('page.service');
})->name('service');

Route::get('/contact', function () {
    return view('page.contact');
})->name('contact');


Route::post('/contact', function ( Request $request) {
    $request->validate([
        'name'=> 'required|max:100|string',
        'email' => 'required|regex:/^[\w\.-]+@[\w\.-]+\.\w+$/|min:10|max:30',
        'subject'=> 'required|string|max:100',
        'message'=> 'required|string|max:200',
    ]);
    $data = $request->except('_token');

    $contact = Contact::create($data);
    return redirect()->back()->with('status','enregistré avec succès');
})->name('contact');

Route::post('/newsletter', function ( Request $request) {
    $request->validate([
        //'email'=> 'required|min:10|max:30|unique:newsletters|regex:/^[0-9+\(\)#\.\s\/ext-]+$/',
        'email' => 'required|unique:newsletters|regex:/^[\w\.-]+@[\w\.-]+\.\w+$/|min:10|max:30',

    ]);
    $data = $request->except('_token');

    $newsletter = Newsletter::create($data);
    return redirect()->back()->with('status','enregistré avec succès');
})->name('newsletter');
Route::get('/carlist', [CarController::class, 'index'])->name('carlist');
Route::get('/cardetail/{id}', [CarController::class, 'show'])->name('cardetail');
Route::get('/booking/{id}', [BookinkController::class, 'create'])->name('clbooking');
Route::post('/bookingsave', [BookinkController::class, 'store'])->name('bookingsave');

Route::post('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('login', function () {
    return response()->json(['error'=>"Login not found"],401);
})->name('login');

// require __DIR__.'/auth.php';

// Route::resource('clientbooking',BookinkController::class);
