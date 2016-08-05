<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/blog');
});

Route::get('blog', 'BlogController@index');
Route::get('blog/{slug}', 'BlogController@showPost');

Route::get('contact','ContactController@showForm');
Route::post('contact','ContactController@sendContactInfo');

Route::get('rss','BlogController@rss');
Route::get('sitemap.xml','BlogController@siteMap');

//admin area
Route::get('admin',function(){
    return redirect('/admin/post');
});

Route::group(['namespace'=>'Admin','middleware'=>'auth'],function(){
    Route::resource('admin/post','PostController',['except'=>'show']);
    // Route::resource('admin/tag','TagController');
    Route::resource('admin/tag','TagController',['except'=>'show']);
    Route::get('admin/upload','UploadController@index');
    Route::post('admin/upload/file','UploadController@uploadFile');
    Route::delete('admin/upload/file','UploadController@deleteFile');
    Route::post('admin/upload/folder','UploadController@createFolder');
    Route::delete('admin/upload/folder','UploadController@deleteFolder');

});


//logging in and out
Route::get('/login','Auth\AuthController@getLogin');
Route::post('/login','Auth\AuthController@postLogin');
Route::get('/logout','Auth\AuthController@getLogout');//登陆可能遇到问题



// API 相关
Route::group(['prefix' => 'api', 'namespace' => 'Api'], function(){
    Route::any('router', 'RouterController@index');  // API 入口
    Route::any('show', 'RouterController@showPost');  // API 入口
});


























//
