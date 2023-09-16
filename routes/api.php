<?php

use App\Http\Controllers\Api\Books\BooksController;
use App\Http\Controllers\Api\Genders\GendersController;
use App\Http\Controllers\UserController;
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

Route::prefix("/v1")->group(function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get("get-books", [BooksController::class, 'getBooks'])->name("get-books");
        Route::get("get-book", [BooksController::class, 'getBook'])->name("get-book");
        Route::post("create-book", [BooksController::class, 'createBook'])->name("create-book");
        Route::put("update-book", [BooksController::class, 'updateBook'])->name("update-book");
        Route::delete("delete-book", [BooksController::class, 'deleteBook'])->name("delete-book");

        //Genders
        Route::get("get-genders", [GendersController::class, 'getGenders'])->name("get-genders");
        Route::get("get-gender", [GendersController::class, 'getGender'])->name("get-gender");
        Route::post("create-gender", [GendersController::class, 'createGender'])->name("create-gender");
        Route::put("update-gender", [GendersController::class, 'updateGender'])->name("update-gender");
        Route::delete("delete-gender", [GendersController::class, 'deleteGender'])->name("delete-gender");
    });
    Route::post("login", [UserController::class, 'index']);
});

