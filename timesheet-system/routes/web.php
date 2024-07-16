<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    $html = '<h1>Hoc lap trinh</h1>';
    return $html ;
});

Route::get('unicode',function(){
    return view('form');
    // return 'Phuong thuc Post cua path /unicode';

});


Route::post('unicode',function(){
    return 'Phuong thuc Post cua path /unicode';
});

Route::put('unicode', function(){
    return 'Phuong thuc put';
});

Route::patch('unicode', function(){
    return 'Phuong thuc patch';
});