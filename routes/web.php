<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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
Route::get('/category/edit/{id}/',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/update/{id}/',[CategoryController::class,'update'])->name('category.update');
Route::get('/category/softdelete/{id}/',[CategoryController::class,'softDelete'])->name('category.sdelete');
Route::get('/category/restore/{id}/',[CategoryController::class,'restore'])->name('category.restore');
Route::get('/category/destroy/{id}/',[CategoryController::class,'destroy'])->name('category.destroy');


//brand route
Route::get('/brand',[BrandController::class,'index'])->name('brand.index');
Route::post('/brand/store/',[BrandController::class,'store'])->name('brand.store');



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
