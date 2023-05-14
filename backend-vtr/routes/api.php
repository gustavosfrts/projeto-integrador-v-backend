<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resource\UserResource;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Produto;

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

Route::prefix('produtos')->group(function (){
    Route::get('/', [Produto::class, 'listagemProdutos'])->name('api.produtos.listagem');
});
Route::get('/teste', function (){
    dd(asset('storage/products/narciso.png'));
});
Route::post("/login", [AuthController::class, "login"]);