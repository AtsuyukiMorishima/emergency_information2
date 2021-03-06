<?php

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

//一般ユーザー観覧可能
Route::get('', 'EmergencyEventController@index')->name('event.index');
Route::get('{id}', 'EmergencyEventController@show')->where('id', '[0-9]+')->name('event.show');
Route::get('category/{id}', 'EmergencyEventController@category');
Route::view('about', 'event.about')->name('event.about');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//管理者アクセス可能
Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('admin', 'EmergencyEventController@admin')->name('admin');
    Route::post('post', 'EmergencyEventController@post');
    Route::get('edit/{emergencyEvent}', 'EmergencyEventController@edit');
    Route::put('update', 'EmergencyEventController@update');
    Route::delete('delete/{emergencyEvent}', 'EmergencyEventController@destroy');
    Route::get('edit/url/{emergencyEvent}', 'EmergencyEventController@editUrl');

    Route::get('updateUser', 'UserController@updateUser')->name('admin.updateUser');
    Route::post('updateUserTable', 'UserController@updateUserTable')->name('admin.updateUserTable');

    Route::post('postUrl', 'SiteUrlController@postUrl');
    Route::put('updateUrl', 'SiteUrlController@updateUrl');

    //総合管理者のみアクセス可能
    Route::get('addUser', 'UserController@addUser')->name('admin.addUser')->middleware('MainAdmin');
    Route::post('addUserTable', 'UserController@addUserTable')->name('admin.addUserTable')->middleware('MainAdmin');
});

Auth::routes(['register' => false]);
