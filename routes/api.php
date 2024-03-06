<?php

use App\Http\Controllers\Api\GetNewsAction;
use App\Http\Controllers\Api\GetNewsItemAction;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('news')->name('news')->group(function () {
    Route::get('/', GetNewsAction::class)->name('.index');
    Route::get('/{news:slug}', GetNewsItemAction::class)->name('.show');
});
