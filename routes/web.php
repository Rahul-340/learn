<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/user-list', [HomeController::class, 'userlist'])->name('admin.user.list');
Route::get('/home/userpost-list', [HomeController::class, 'userPostlist'])->name('admin.userpost.list');

// users route
Route::post('/home/adduser', [UserController::class, 'adduser'])->name('admin.adduser');
Route::get('/home/edituser/{id}', [UserController::class, 'edituser'])->name('admin.edituser');
Route::get('/home/userstatus/{id}', [UserController::class, 'userstatus'])->name('admin.userstatus');
Route::post('/home/updateuser', [UserController::class, 'updateuser'])->name('admin.updateuser');
Route::get('/home/deleteuser/{id}', [UserController::class, 'deleteuser'])->name('admin.deleteuser');

// posts route
Route::post('/home/addpost', [UserController::class, 'userpost'])->name('user.userpost');
Route::get('/home/editpost/{id}', [UserController::class, 'editpost'])->name('admin.editpost');
Route::post('/home/updatepost', [UserController::class, 'updatepost'])->name('admin.updatepost');
Route::post('/home/deletepost/', [UserController::class, 'deletepost'])->name('admin.deletepost');
Route::get('/home/userpoststatus/{id}', [UserController::class, 'userpoststatus'])->name('admin.userpoststatus');
