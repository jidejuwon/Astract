<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;

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


Route::get('/sign-in',[AuthController::class,'userAuth'])->name('auth');
Route::get('/', [UserController::class,'index'])->name('home');
Route::post('login',[AuthController::class,'userLogin'])->name('login');
Route::post('logout',[AuthController::class,'userLogout'])->name('logout');
Route::get('register',[AuthController::class,'registerUser'])->name('register');
Route::post('create',[UserController::class,'create'])->name('create');
Route::post('unverify/{id}',[UserController::class,'unverify'])->name('unverify');
Route::post('verify/{id}',[UserController::class,'verify'])->name('verify');
Route::post('delete/{id}',[UserController::class,'delete'])->name('delete');
Route::post('send-message',[MessageController::class,'sendMessage'])->name('sendMessage');



Route::group(['prefix' => 'admin'],function(){
    Route::get('/',[AuthController::class,'adminAuth'])->name('admin.auth');
    Route::post('login',[AuthController::class,'adminLogin'])->name('admin.login');
    Route::post('logout',[AuthController::class,'adminLogout'])->name('admin.logout');
    Route::get('home',[AdminController::class,'index'])->name('admin.home');
    Route::get('category',[CategoryController::class,'index'])->name('admin.category');
    Route::post('create-category',[CategoryController::class,'store'])->name('admin.create-category');
    Route::post('update-category',[CategoryController::class,'update'])->name('admin.update-category');
    Route::post('delete-category',[CategoryController::class,'destroy'])->name('admin.delete-category');
    Route::get('messages',[MessageController::class,'messages'])->name('user.messages');

});
