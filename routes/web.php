<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterationController;
use App\Http\Controllers\SessionController;
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

Route::get('/' , [PostController::class , 'posts']);
Route::get('post/{id}' , [PostController::class , 'post']);


Route::post('post/{id}/comment/store' , [CommentController::class , 'StoreComment']);


Route::get('category/{id}' , [CategoryController::class , 'showpostincat']);



##Auth::
#register
Route::get('/register' , [RegisterationController::class , 'showform']);
Route::post('/register' , [RegisterationController::class , 'store']);

#login
Route::get('/login' , [SessionController::class , 'showform']);
Route::post('/login' , [SessionController::class , 'store']);
#logout
Route::get('/logout' , [SessionController::class , 'destroy']);



Route::group(['middleware'=>'roles','roles'=>['admin']] , function(){
    Route::get('/admin' ,[PostController::class , 'admin']);
    Route::post('/add-role' ,[PostController::class , 'add_role']);
    Route::get('category/{id}/delete' , [PostController::class , 'deleteCategory']);
    Route::post('category/add' , [PostController::class , 'addCategory']);
    Route::post('category/{id}/update' , [PostController::class , 'updateCategory']);
});

Route::group(['middleware'=>'roles','roles'=>['supervisor' , 'admin']] , function(){
    Route::get('/editor' ,[PostController::class , 'editor']);
});

Route::group(['middleware'=>'roles','roles'=>['user','supervisor' , 'admin']] , function(){
    Route::post('/like' ,[PostController::class , 'like'])->name('like');
    Route::post('/dislike' ,[PostController::class , 'dislike'])->name('dislike');
    Route::post('category/{cat_id}/post/store' , [PostController::class , 'StorePost']);
    Route::post('category/post/store' , [PostController::class , 'addpost']);

    Route::get('profile/{user_id}' , [PostController::class , 'profile']);

    Route::get('post/{id}/delete' , [PostController::class , 'deletePost']);
    Route::post('post/{id}/update' , [PostController::class , 'updatePost']);




});


