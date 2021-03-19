<?php

use App\Http\Controllers\admin\product\productController;
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

Route::get('/', function()
{
    return view('welcome');
});

Route::group(['prefix'=>'dashboard', 'middleware'=>['auth', 'verified']], function(){
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    
    Route::group(['prefix'=>'products', 'namespace'=>'admin\product'], function(){
        Route::get('/', 'productController@index');
        Route::get('create', 'productController@create');    
        Route::get('edit/{var}', 'productController@edit');
        Route::post('store', 'productController@store');
        Route::put('update', 'productController@update');
        Route::delete('destroy/{id}', 'productController@destroy');
    });
});





/*
Route::group(['prefix'=>'categories', 'namespace'=>'admin\categories'], function(){
    Route::get('all', 'categoryController@index');
    Route::get('create', 'categoryController@create');    
    Route::get('edit', 'categoryController@edit');
});

*/


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
