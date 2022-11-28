<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoneController;
use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\MakeController;
use App\Http\Controllers\Api\CancelController;
use App\Http\Controllers\Api\AllocateController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::prefix('allocate')->group(function(){

    Route::get('all' , [AllocateController::class,'all'])->name('allocate.all');
    Route::get('{user}/{document}' , [AllocateController::class,'exclusive'])->name('api.allocate.exclusive');
});


Route::prefix('done')->group(function(){

    Route::get('{user}/{document}' , [DoneController::class,'do'])->name('api.done');
});


Route::prefix('make')->group(function(){

    Route::get('registrar' , [MakeController::class,'registrar'])->name('make.registrar');
    Route::get('reviewer' , [MakeController::class,'reviewer'])->name('make.reviewer');
    Route::get('document' , [MakeController::class,'document'])->name('api.make.document');
});


Route::prefix('cancel')->group(function(){

    Route::get('{user}/{document}' , [CancelController::class,'cancel'])->name('api.cancel');
});


Route::prefix('list')->group(function(){

    Route::get('user' , [ListController::class,'users'])->name('.api.list.users');
    Route::get('document' , [ListController::class,'documents'])->name('.api.list.documents');
});


