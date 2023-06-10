<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PublicController::class, 'index']);
Route::get('/book-list', [PublicController::class, 'bookList']);

Route::middleware('only_guest')->group(function() {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function() {

    Route::middleware('only_client')->group(function() {
        Route::get('profile', [UserController::class, 'profile']);
        Route::get('rent-logs-user', [UserController::class, 'rentLogUser']);
        Route::put('edit-profile/{slug}',[UserController::class,'editProfile']);
        Route::put('edit-password/{slug}',[UserController::class,'editPassword']);
    });

    Route::middleware('only_admin')->group(function() {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('books', [BookController::class, 'index']);
        Route::post('add-book',[BookController::class,'addBook']);
        Route::put('edit-book/{slug}',[BookController::class,'editBook']);
        Route::post('delete-book/{slug}',[BookController::class,'deleteBook']);
        Route::get('deleted-list-book',[BookController::class,'deletedListBook']);
        Route::post('book-restore/{slug}', [BookController::class, 'restore']);

        
        Route::get('category', [CategoryController::class, 'category']);
        Route::post('add-category',[CategoryController::class,'addCategory']);
        Route::put('edit-category/{slug}',[CategoryController::class,'editCategory']);
        Route::post('delete-category/{slug}',[CategoryController::class,'deleteCategory']);

        Route::get('users', [UserController::class, 'index']);
        Route::get('registered-users', [UserController::class, 'registeredUsers']);
        Route::get('user-approve/{slug}', [UserController::class, 'approve']);
        Route::get('user-detail/{slug}', [UserController::class, 'show']);
        Route::post('ban-user/{slug}',[UserController::class,'destroy']);
        Route::get('users-banned', [UserController::class, 'bannedUsers']);
        Route::post('user-restore/{slug}', [UserController::class, 'restore']);

        Route::get('book-rent', [BookRentController::class, 'index']);
        Route::post('book-rent', [BookRentController::class, 'store']);
        
        Route::get('rent-logs', [RentLogController::class, 'index']);

        Route::get('book-return', [BookRentController::class, 'returnBook']);
        Route::post('book-return', [BookRentController::class, 'bookReturn']);
    });
    
    
    
    
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('logout', [AuthController::class, 'logout']);
});