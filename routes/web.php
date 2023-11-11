<?php

use App\Models\Details;
use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingsController;
use App\Http\Controllers\AuthenticationController;

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

Route::get('/', function () {
    return view('welcome');
});

#examples the route method is used to send users to different webpages. the response can take strings, html text etc. can take params of status code and also take headers and their content type
Route::get('/users', function () {
    return response("<h1>Hello Class</h1>", 200)->header('content-type', 'text/plain');
});

// using id's
Route::get('/posts/{id}', function ($id) {
    return response("This is post " . $id);
});

#constrainsts - limiting the get request reach with args
Route::get('/sections/{id}', function ($id) {
    return response("This is section " . $id);
})->where('id', '[0-9]+');

#debugging dd or ddd for advanced debugging
Route::get('/search', function (Request $request) {
    // dd($request); any code below this will be ignored
    return $request->name . ' ' . $request->age;
});

/* 

// route takes care of rerouting takes in data as array
Route::get('/jobdetail/{id}', function ($id) {
    return view(
        'jobdetail',
        ['one_job' => Listings::find($id)]
    );
});

//handling errors when an unfound id is entered -> long process

Route::get('/jobdetail/{id}', function ($id) {

    $listing = Listings::find($id);

    if ($listing) {

        return view('jobdetail', [
            'one_job' => $listing
        ]);

    } else {

        abort('404');
    }
});

// you can do the above also with route model binding. 

Route::get('/jobdetail/{details}', function (Listings $details) {
    return view('jobdetail', [
        'one_job' => $details
    ]);
});

*/

// using controllers

// show all
Route::get('/', [ListingsController::class, 'index']);

// route to show one job
Route::get('/jobdetail/{details}', [ListingsController::class, 'show']);

// route to return create job view
Route::get('/create_job', [ListingsController::class, 'create'])->middleware('auth');

// route to store job 
Route::post('/', [ListingsController::class, 'store'])->middleware('auth');

// route to return edit job view
Route::get('/{listings}/edit', [ListingsController::class, 'edit'])->middleware('auth');

// route to update job
Route::put('/{listings}', [ListingsController::class, 'update'])->middleware('auth');

// to delete
Route::delete('/{listings}', [ListingsController::class, 'destroy'])->middleware('auth');

// show manage listings page
Route::get('/manage', [ListingsController::class, 'manage'])->middleware('auth');

// ================================================ user routes ====================================================

// register route for view
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// store users
Route::post('/users', [UserController::class, 'store']);

// log out user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form view route
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// log user in 
Route::post('/users/authenticate', [UserController::class, 'authenticate']);







