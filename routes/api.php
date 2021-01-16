<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('api')->post('comment', 'ApiController@addComment')->name('api.addComment');
Route::middleware('api')->post('addViewCount', 'ApiController@addViewCount')->name('api.addViewCount');
Route::middleware('api')->post('likeArticle', 'ApiController@likeArticle')->name('api.likeArticle');
