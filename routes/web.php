<?php

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
    $threads = \App\Thread::paginate(15);

    return view('welcome', compact('threads'));
});

Route::get('/changepassword', 'ChangePasswordController@create');

Route::resource('/thread', 'ThreadController');
Route::resource('comment', 'CommentController', ['only' => ['update', 'destroy']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile');

Route::post('comment/create/{thread}', 'CommentController@addThreadComment')->name('threadcomment.store');
Route::post('reply/create/{comment}', 'CommentController@addReplyComment')->name('replycomment.store');
Route::post('/thread/mark-as-solution', 'ThreadController@markAsSolution')->name('markAsSolution');
Route::post('comment/like', 'LikeController@toggleLike')->name('toggleLike');
Route::post('/change/password', 'ChangePasswordController@update')->name('change_password');
Route::post('/change/image', 'UserProfileController@update')->name('change_image');