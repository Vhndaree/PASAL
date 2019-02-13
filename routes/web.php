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

/*Route::get('/{name}', function ($name) {
    return 'User Name: '.$name;
});*/


// Route::get('/',function(){
//     return view('auth.login');
// });     


Route::get('/vendor/create','TablesController@addVendor');
Route::get('/item/create','TablesController@addItem');
Route::get('/purchase/create','TablesController@addPurchase');
Route::get('/sales/create','TablesController@addsales');


Route::get('/stockCalculator',function(){
    return view('tools.stockcalculator');
});

Route::resource('/posts/item','ItemController');
Route::resource('/posts/purchase','PurchaseController');
Route::resource('/posts/vendor','VendorController');
Route::resource('/posts/sales','SaleController');
Route::resource('/posts/stock','StockController');

Auth::routes();

Route::get('/main','HomeController@main');
Route::get('/', 'HomeController@index')->name('map');  

Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('/manager', 'HomeController@index')->name('manager');
Route::get('/editor', 'HomeController@index')->name('editor');

Route::get('/home', 'HomeController@index');
Route::get('/home/role', 'HomeController@createRoles')->name('home-role');
Route::get('/home/assign/admin', 'HomeController@testRoleAssign')->name('home-assign');
Route::get('/home/assign/manager', 'HomeController@RoleAssignManager')->name('home-assign');
Route::get('/home/assign/editor', 'HomeController@RoleAssignEditor')->name('home-assign');

Route::get('/dashboard','HomeController@index');

Route::resource('/user','UserController');   