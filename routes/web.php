<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/policy", "\App\Http\Controllers\HomeController@policy")->name("policy");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/api", function () {
    return [1, 2, array("test" => 'test')];
});



// Vote Routes

Route::get('/vote/create', "\App\Http\Controllers\VoteController@index")->name('vote.create');
Route::post("/vote/create", "\App\Http\Controllers\VoteController@store")->name('vote.store');

Route::get("/vote/results", function () {
    $data['votes'] = DB::table('votes')->get();
    $data['yesVotes'] = DB::table('votes')->where('vote', 1)->count('vote');
    $data['noVotes'] = DB::table('votes')->where('vote', 0)->count('vote');

    // dd($data);
    // return response()->json($data);
    // return $data;

    return view("vote.results", ['data' => $data]);
})->name('vote.results');

Route::get('/vote/show/{id}', function ($id) {
    $vote = DB::table('votes')->find($id);
    // dd($vote);
    return view('vote.single', ['vote' => $vote]);
});

// Add routes for User resource controller
// First we add an admin prefix and auth middleware to check for the role.
// the middle ware will enforce the user to be have roles to manage users.
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    // Now we add the routes
    Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
});