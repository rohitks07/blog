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

Route::get('clear', function () {
	$exitCode = Artisan::call('config:clear');
	$exitCode = Artisan::call('cache:clear');
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('view:clear');
	Session::flash('success', 'All Clear');
	echo "DONE";
});

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['as'=>'products.','prefix'=>'products'] ,function(){
    Route::get('/','ProductController@show')->name('all');
    Route::get('/{product}','ProductController@singleProduct')->name('single');
});



Route::group(['as'=>'admin.', 'middleware' => (['auth','admin']) ,'prefix' => 'admin' ], function(){
    Route::get('category/{category}/remove','CategoryController@remove')->name('category.remove');
    Route::get('category/trash','CategoryController@trash')->name('category.trash');
    Route::get('category/restore/{id}','CategoryController@restoreData')->name('category.recover');

    Route::view('product/extras', 'admin.partials.extras')->name('product.extras');
    Route::get('product/{product}/remove','ProductController@removeToTrashProduct')->name('product.remove');
    Route::get('product/trash','ProductController@trashProductList')->name('product.trash');
    Route::get('product/restore/{id}','ProductController@restoreProduct')->name('product.recover');

    Route::get('profile/states/{id?}','ProfileController@getStates')->name('profile.states');
    Route::get('profile/cities/{id?}','ProfileController@getCities')->name('profile.cities');

    Route::get('/dashboard' ,'AdminController@dashboard')->name('dashboard');
    Route::resource('product' ,'ProductController');
    Route::resource('category' ,'CategoryController');
    Route::resource('profile','ProfileController');
});


