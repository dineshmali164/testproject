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

use App\Http\Controllers\admin\brandController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('admin.index');
}); 
/* Route::get('/frontindex', function () {
    return view('front.index');
});  */

Route::middleware(['auth'])->namespace('admin')->prefix('admin')->group(function () {
    // Route::post('/categorystatus', 'categorycrud@catstatus');
    Route::resource('category','categorycrud');
    Route::post('categorystatus','categorycrud@catstatus');
    Route::resource('subcategory','subcategoryController');
    Route::post('subcatstatus','subcategoryController@subcatstatus');
    Route::resource('subsubcategory','subsubcategoryController');
    Route::post('get_subcategory_data','subsubcategoryController@get_sub_ajax');
    Route::post('subsubcatstatus','subsubcategoryController@subsubcatstatus');
    Route::resource('brand', 'brandController');
    Route::post('brand_subcategory_data','brandController@brand_subcategory_data');
    Route::post('brand_subsubcategory_data','brandController@brand_subsubcategory_data');
    Route::post('brandstatus','brandController@brandstatus');
    Route::resource('type','TypeController');
    Route::post('typestatus','TypeController@typestatus');
    Route::post('type_subcategory_data','typeController@type_subcategory_data');
    Route::post('type_subsubcategory_data','typeController@type_subsubcategory_data');
    Route::resource('product','ProductController');
    Route::post('product_subcategory_data','productController@product_subcategory_data');
    Route::post('product_subsubcategory_data','productController@product_subsubcategory_data');
});

Route::namespace('front')->prefix('front')->group(function (){
    Route::get('/frontindex','frontIndexController@menu');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
