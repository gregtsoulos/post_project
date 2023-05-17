<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); 


/*								Admin Panel 					 */


Route::get('/admin', function (Request $request) {

	if(!$request->session()->has('username')){

		return redirect('admin/login');

	} else {


    return view('admin/home');

    }

	
//	return view('admin/home');
});



Route::get('/admin/login', function () {
    return view('admin/login');
});

Route::post('/admin/login_submit', 'App\Http\Controllers\Admin@postLogin');

Route::get('/admin/logout', 'App\Http\Controllers\Admin@adminLogout');


/*					Admin Posts						*/

Route::get('/admin/add_post', function (Request $request) {

	if(!$request->session()->has('username')){

		return redirect('admin/login');

	} else {

		return view('admin/add_post');

	}

});

Route::post('/admin/insert_post', 'App\Http\Controllers\Admin@insert_post');


Route::get('/admin/edit_post/{id}', function (Request $request,$id) {

	if(!$request->session()->has('username')){

		return redirect('admin/login');

	} else {

    $single_post = DB::select('select * from posts WHERE id ='.$id);

    return view('admin/edit_post',['single_post'=>$single_post]);

    }
	
});

Route::post('/admin/update_post/{id}', 'App\Http\Controllers\Admin@update_post');

Route::get('/admin/post_list', function (Request $request) {

	if(!$request->session()->has('username')){

		return redirect('admin/login');

	} else {

    $all_posts = DB::select('select posts.* from posts');

    return view('admin/post_list',['all_posts'=>$all_posts]);

    }
	
});


Route::get('/admin/update_password', function (Request $request) {

	if(!$request->session()->has('username')){

		return redirect('admin/login');

	} else {

    return view('admin/update_password');

    }
	
});

Route::post('/admin/update_password', 'App\Http\Controllers\Admin@update_password');



//					Deletions						//

Route::get('admin/delete_post/{id}','App\Http\Controllers\Admin@delete_post');