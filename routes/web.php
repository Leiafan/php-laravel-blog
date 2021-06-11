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

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth', 'admin']], function(){
    Route::get('/moderation', 'DashboardController@dashboard')->name('admin.dashboard');
    Route::post('/moderate/{id}', 'DashboardController@moderate')->name('admin.moderate');
    Route::get('/approve','DashboardController@not_approved')->name('admin.approve');
    Route::get('/upload_article','UploadController@article')->name('admin.upload_article');
    Route::post('/upload','UploadController@upload')->name('admin.upload');
    Route::post('/add_heading', 'DashboardController@heading')->name('admin.heading');
    Route::get('/article/{id}', 'DashboardController@show')->name('admin.article');
});

Route::group(['prefix' =>'moderator', 'namespace'=>'Moderator', 'middleware'=>['auth', 'moderator']], function(){
    Route::get('/moderation', 'DashboardController@not_approved')->name('moderator.approve');
    Route::post('/article/{id}', 'DashboardController@moderate')->name('moderator.moderate');
    Route::get('/upload_article','UploadController@article')->name('moderator.upload_article');
    Route::post('/upload','UploadController@upload')->name('moderator.upload');
    Route::get('/article/{id}', 'DashboardController@show')->name('moderator.article');
});

Route::group(['prefix'=>'user', 'namespace'=>'User', 'middleware'=>['auth']], function(){
    Route::any('/upload_article', 'UploadController@article')->name('user.article');
    Route::post('/upload', 'UploadController@upload')->name('user.upload');
});

Route::any('/', 'MainController@index')->name('index');
Route::any('/search/{heading}', 'MainController@search')->name('index.search');
Route::any('/article/{id}', 'ArticleController@show')->name('article');
Route::resource('comment', 'CommentController');
Auth::routes();
