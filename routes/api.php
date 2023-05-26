<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Produto;
use App\Http\Controllers\Garantia;
use App\Http\Controllers\Manual;
use App\Http\Controllers\Perfil;

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

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::prefix('auth/produtos')->group(function () {
        Route::get('/', [Produto::class, 'listagemProdutosLogado'])->name('api.produtos.listagem');
    });
    Route::prefix('garantias')->group(function () {
        Route::get('/', [Garantia::class, 'listagemGarantias'])->name('api.garantias.listagem');
    });
    Route::prefix('manuais')->group(function () {
        Route::get('/', [Manual::class, 'listagemManuais'])->name('api.manuais.listagem');
    });
    Route::prefix('perfis')->group(function () {
        Route::get('/', [Perfil::class, 'perfil'])->name('api.perfil');
        Route::put('/', [Perfil::class, 'update'])->name('api.perfil.update');
    });
    Route::prefix('transferencia')->group(function () {
        Route::post('/', [Produto::class, 'transferencia'])->name('api.tranferencia');
    });
});

Route::prefix('produtos')->group(function () {
    Route::get('/', [Produto::class, 'listagemProdutos'])->name('api.produtos.listagem');
});

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);
