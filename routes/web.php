<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Barang;





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
    return view('welcome');
});
Route::get('/get', [Barang::class,'getData']);
Route::post('/pushdata',[Barang::class,'store']);

Route::post('/setdata',[Barang::class,'update']);
Route::get('/hapus/{id}',[Barang::class,'hapus']);
Route::get('/getdetail/{id}',[Barang::class,'getDetail']);
//Route::get('/getdetail/{id}','Barang@getDetail');

//Route::post('/post', 'App\Http\Controllers\Barang@store');