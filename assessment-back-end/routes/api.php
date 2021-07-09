<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/category',CategoryController::class);
Route::resource('/article',ArticleController::class);
Route::get('/article/search/{category_id}',[ArticleController::class,'searchByCategory_id']);
Route::post('/comment',[CommentController::class,'store']);
Route::get('/comment/{article_id}',[CommentController::class,'listComments']);

