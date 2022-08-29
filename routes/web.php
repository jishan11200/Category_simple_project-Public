<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
//Category Route
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::post('/category/store/',[CategoryController::class,'store'])->name('category.store');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        //eluoquent ORM
        // $users  = User::all();

        //query Builder
        $users = DB::table('users')->get();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});
