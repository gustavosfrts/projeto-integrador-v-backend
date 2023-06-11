<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Produto;
use App\Http\Controllers\Garantia;
use App\Http\Controllers\Manual;
use App\Http\Controllers\Perfil;
use App\Http\Controllers\Forum;
use App\Http\Controllers\ImageController;

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
    Route::prefix('forums')->group(function () {
        Route::get('/', [Forum::class, 'listagemForums'])->name('api.forums.listagem');
        Route::get('/{id}', [Forum::class, 'forum'])->name('api.forum');
        Route::post('/', [Forum::class, 'createForum'])->name('api.forum.create');
        Route::put('/{id}', [Forum::class, 'updateForum'])->name('api.forum.update');
        Route::delete('/{id}', [Forum::class, 'deleteForum'])->name('api.forum.delete');
        Route::prefix('comentarios')->group(function () {
            Route::post('/', [Forum::class, 'createComentario'])->name('api.comentarios.create');
            Route::put('/{id}', [Forum::class, 'updateComentario'])->name('api.comentarios.update');
            Route::delete('/{id}', [Forum::class, 'deleteComentario'])->name('api.comentarios.delete');
        });
    });
    Route::prefix('images')->group(function () {
        Route::post('upload', [ImageController::class, 'storeImage'])->name('api.images.upload');
    });
});

Route::prefix('produtos')->group(function () {
    Route::get('/', [Produto::class, 'listagemProdutos'])->name('api.produtos.listagem');
});

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);
