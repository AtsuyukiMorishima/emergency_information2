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

Route::get('', 'EmergencyEventController@index')->name('event.index');
Route::get('{id}', 'EmergencyEventController@show')->where('id', '[0-9]+')->name('event.show');
Route::get('category/{id}', 'EmergencyEventController@category');
Route::view('about', 'event.about')->name('event.about');

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('admin', 'EmergencyEventController@admin')->name('admin');
    Route::post('post', 'EmergencyEventController@post');
    Route::get('edit/{emergencyEvent}', 'EmergencyEventController@edit');
    Route::put('update', 'EmergencyEventController@update');
    Route::delete('delete/{emergencyEvent}', 'EmergencyEventController@destroy');
    Route::get('edit/url/{emergencyEvent}', 'EmergencyEventController@editUrl');

    Route::get('addUser', 'UserController@addUser')->name('admin.addUser')->middleware('mainAdmin');
    Route::post('addUserTable', 'UserController@addUserTable')->name('admin.addUserTable')->middleware('mainAdmin');
    Route::get('updateUser', 'UserController@updateUser')->name('admin.updateUser');
    Route::post('updateUserTable', 'UserController@updateUserTable')->name('admin.updateUserTable');

    Route::post('postUrl', 'SiteUrlController@postUrl');
    Route::put('updateUrl', 'SiteUrlController@updateUrl');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::any('/register', [App\Http\Controllers\HomeController::class, 'index']);
