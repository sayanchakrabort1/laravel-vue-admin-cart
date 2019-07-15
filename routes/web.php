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


/* ---------------------------------- USER SECTION -----------------------------------------*/

Route::get('/', 'RegisterController@index' )->name('index'); // Landing page display

Route::get('/register', 'RegisterController@register' )->name('register'); //Register Display

Route::get('/login', 'RegisterController@login' )->name('login'); //Register Display

Route::post('/check', 'RegisterController@check' )->name('check'); //Validate Register

Route::post('/verify', 'RegisterController@verify' )->name('verify'); //Verifying Login

Route::middleware('user')->group(function () {

    Route::get( '/mainpage', 'MainController@index' )->name('mainpage')->middleware('web'); //Mainpage Redirection

    Route::get( '/logout', 'MainController@logout' )->name('logout'); // Logout

    Route::get( '/profile', 'MainController@profile' )->name('profile'); // Display Profile

    Route::post( '/edit', 'MainController@edit' )->name('edit'); // Edit Profile

    Route::post('/editpass', 'MainController@editpass' )->name('editpass'); // Edit profile Password

    Route::get('/addproduct', 'MainController@addproduct' )->name('addproduct'); // Add product

    Route::post('/addprod', 'MainController@addprod' )->name('addprod');  // Add product Handler

    Route::get('/showproducts', 'MainController@showproducts' )->name('showproducts');  // Show product

    Route::get('/manageproduct', 'MainController@manageproduct' )->name('manageproduct');  // Manage product view

    Route::post('/prodmanager', 'MainController@prodmanager' )->name('prodmanager');  // Manage Product handler

    Route::get('/editproduct', 'MainController@editproduct' )->name('editproduct'); // Product value edit/ Delete

    Route::post('/editchecker', 'MainController@editchecker' )->name('editchecker'); // Product Edit Handler

});

/* ---------------------------------- USER SECTION END -----------------------------------------*/

/* ---------------------------------- Admin SECTION -----------------------------------------*/


Route::get('/admin', 'AdminController@index' )->name('adminIndex');

Route::get('/admin/login', 'AdminController@login' )->name('adlogin');

Route::post('/admin/verify', 'AdminController@verify' )->name('adverify');

Route::get('/admin/dashboard', 'AdminController@dashboard' )->name('addashboard')->middleware('web');

Route::post('/mailCatcher', 'AdminController@mailCatcher' )->name('mailCatcher');

Route::post('/adminCreate', 'AdminController@adminCreate' )->name('adminCreate');













/* ---------------------------------- Admin SECTION -----------------------------------------*/