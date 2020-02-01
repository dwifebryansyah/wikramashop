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

use App\Role;

Route::get('/', function () {
    return view('layouts.pages.login_custom');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->prefix('admin')->group(function () {

	Route::get('/', 'HomeController@dashboard')->name('dashboard');

	Route::resource('categories', 'CategoryController')->except([
	        'show','destroy'
	    ]);

	Route::resource('units', 'UnitController')->except([
	        'show','destroy'
	    ]);

	Route::resource('roles', 'RoleController')->except([
        'show','destroy'
    ]);

    Route::resource('products', 'ProductController')->except([
        'show','destroy'
    ]);

    Route::resource('carts', 'CartController')->except([
        'show','destroy','create'
    ]);

     Route::resource('adminAccount', 'AdminAccountController')->except([
        'show','destroy'
    ]);

     Route::resource('suppliers', 'SupplierController')->except([
        'show','destroy'
    ]);

     Route::resource('orders', 'OrderController')->except([
        'show','destroy'
    ]);

     Route::resource('logs', 'LogController')->except([
        'destroy'
    ]);

     Route::resource('reports', 'ReportController')->except([
        'show','destroy'
    ]);


});

//Custom
Route::get('/signUp', function () {

    $roles = Role::where('name','<>','Admin')->get();
    return view('layouts.pages.register_custom', compact('roles'));

})->name('signUp');

Route::get('/signIn', function () {

    return view('layouts.pages.login_custom');
})->name('signIn');

Route::post('/regiter/process', 'RegisterCustomController@register')->name('regiter.process');
//
Route::get('/categories/{category}','CategoryController@destroy')->name('categories.destroy');
Route::get('/units/{unit}','UnitController@destroy')->name('units.destroy');
Route::get('/roles/{role}','RoleController@destroy')->name('roles.destroy');
Route::get('/products/{product}','ProductController@destroy')->name('products.destroy');


Route::get('/getUnits/{id}', 'ApiController@getUnits')->name('getUnit');
Route::get('/getConvert/{id}', 'ApiController@getConvert')->name('getConvert');
Route::get('/getProduct/{id}', 'ApiController@getProduct')->name('getProduct');
Route::get('/getInformations/{id}', 'ApiController@getInformations')->name('getInformations');
Route::get('/handleConvert/{id}', 'ApiController@handleConvert')->name('handleConvert');

//Pasok
Route::put('/suppliers/{updatePasok}','SupplierController@updatePasok')->name('suppliers.updatePasok');
Route::post('/admin/suppliers/pasok','SupplierController@pasok')->name('suppliers.pasok');
//AdminAkun
Route::get('/adminAccount/{account}','AdminAccountController@destroy')->name('adminAccount.destroy');
Route::get('/adminAccount/accept/{id}','AdminAccountController@accept')->name('adminAccount.accept');
//Cart
Route::get('/carts/{cart}','CartController@destroy')->name('carts.destroy');
Route::post('/admin/carts/','CartController@create')->name('carts.create');
Route::post('/admin/store/','CartController@store')->name('carts.store');
//Orders
Route::get('/orders/struk', 'ReportController@struk')->name('orders.struk');
Route::get('/orders/{order}','OrderController@destroy')->name('orders.destroy');
Route::get('/orders/print/{id}', 'ReportController@print')->name('orders.print');
//AdminAccount
Route::get('/adminAccount/{account}','AdminAccountController@destroy')->name('adminAccount.destroy');
Route::get('/adminAccount/accept/{id}','AdminAccountController@accept')->name('adminAccount.accept');