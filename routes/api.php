<?php

use App\Http\Controllers\API\ArticlesController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get( 'articles', [ ArticlesController::class, 'index' ] );
Route::get( 'articles/{id}', [ ArticlesController::class, 'show' ] );
Route::post( 'articles', [ ArticlesController::class, 'store' ] );
Route::put( 'articles/{id}', [ ArticlesController::class, 'update' ] );
Route::patch( 'articles/{id}', [ ArticlesController::class, 'updatePatch' ] );
Route::delete( 'articles/{id}', [ ArticlesController::class, 'destroy' ] );

Route::apiResource( 'posts', PostsController::class );
