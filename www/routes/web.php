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

Route::get('/{any}', 'App\Http\Controllers\PageController@index')->where('any', '.*');




//WARNING! I KNOW ITS NOT THE BEST PRACTICE BUT I DONT HAVE ENOUGH TIME. FOR NOW ITS OK. IN PRODUCTION I MOVE THINGS LIKE THIS IN API SECTION.
Route::post('/api/fibo/{number}', 'App\Http\Controllers\Api\V1\FiboController@handle');
