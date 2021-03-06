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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::view('/', 'welcome')->name('home');

Route::get('/statuses', 'StatusesController@index')
    ->name('statuses.index');
Route::post('statuses', 'StatusesController@store')
    ->name('statuses.store');


Route::post('/statuses/{status}/likes', 'StatusLikeController@store')
    ->name('statuses.likes.store')
    ->middleware('auth');
Route::delete('/statuses/{status}/likes', 'StatusLikeController@destroy')
    ->name('statuses.likes.destroy')
    ->middleware('auth');

Route::post('/comments/{comment}/likes', 'CommentsLikeController@store')
    ->name('comments.likes.store')
    ->middleware('auth');
Route::delete('/comments/{comment}/likes', 'CommentsLikeController@destroy')
    ->name('comments.likes.destroy')
    ->middleware('auth');

Route::post('/statuses/{status}/comments', 'StatusCommentsController@store')
    ->name('statuses.comments.store')
    ->middleware('auth');

Route::get('@{user}', 'UsersController@show')->name('users.show');

Route::get('/users/{user}/statuses', 'UsersStatusesController@index')
    ->name('users.statuses.index');

Route::post('/friendships/{recipient}', 'FriendshipsController@store')
    ->name('friendship.store')
    ->middleware('auth');
Route::delete('/friendships/{recipient}', 'FriendshipsController@destroy')
    ->name('friendship.destroy')
    ->middleware('auth');

Route::post('/accept-friendships/{sender}', 'AcceptFriendshipsController@store')
    ->name('accept-friendships.store')
    ->middleware('auth');
Route::delete('/accept-friendships/{sender}', 'AcceptFriendshipsController@destroy')
    ->name('accept-friendships.destroy')
    ->middleware('auth');

Route::auth();