<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
	if (Auth::guest()) {
		return redirect()->route('login');	
	}else{
		return redirect()->route('product.index');	
	}
});

Auth::routes(['reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/','middleware' => ['auth']], static function () {
	Route::resource('product', ProductController::class);
});
