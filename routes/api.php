<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Public routes
Route::post('/user', [AuthController::class, 'signup']);
Route::post('/user/login', [AuthController::class, 'login']);

// Protected routes (requires authentication)
Route::middleware('auth:api')->group(function () {
    Route::get('/user/me', [AuthController::class, 'me']);          // Get authenticated user's details
    Route::post('/user/logout', [AuthController::class, 'logout']); // Logout the user
    Route::put('/user/{id}', [AuthController::class, 'update']);    // Update user details
    Route::delete('/user/{id}', [AuthController::class, 'destroy']); // Delete user
    Route::get('/user/{id}', [AuthController::class, 'show']);      // Fetch user details
});


// //User Api's
// Route::post('/signup', [AuthController::class, 'signup']);
// Route::put('/user/{id}', [AuthController::class, 'update']);
// Route::get('/user/{id}', [AuthController::class, 'show']);
// Route::delete('/user/{id}', [AuthController::class, 'destroy']);

// Route::post('/login', [AuthController::class, 'login']);

//Payment routes
Route::post('/create-order', [PaymentController::class, 'createOrder']);
Route::post('/capture-payment', [PaymentController::class, 'capturePayment']);

//Products api

Route::prefix('products')->group(function () {
    // Get all products with optional filters
    Route::post('/fetch', [ProductController::class, 'getAllProducts']);

    // Create a new product
    Route::post('/', [ProductController::class, 'store']);

    // Update a product using product_code
    Route::put('/{product_code}', [ProductController::class, 'update']);

    // Delete a product using product_code
    Route::delete('/{product_code}', [ProductController::class, 'destroy']);

    // Search for products
    Route::post('/search', [ProductController::class, 'search']);
});


//Category Api
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category_code}', [CategoryController::class, 'show']);  // Fetch category by code

//Admin Api Route
Route::post('/admin/login', [AdminController::class, 'login']); // Admin login
Route::post('/admin', [AdminController::class, 'store']);         // Store a new admin

// Protected routes (authentication required)
Route::middleware('auth:api')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);          // Fetch all admins
    Route::get('/admin/{id}', [AdminController::class, 'show']);      // Fetch a specific admin by ID
    Route::put('/admin/{id}', [AdminController::class, 'update']);    // Update an existing admin by ID
    Route::delete('/admin/{id}', [AdminController::class, 'destroy']); // Delete an admin by ID
    Route::post('/categories', [CategoryController::class, 'store']);    // Create a new category
    Route::put('/categories/{category_code}', [CategoryController::class, 'update']); // Update category by code
    Route::delete('/categories/{category_code}', [CategoryController::class, 'destroy']); // Delete category by code

});
// Route::get('/admin', [AdminController::class, 'index']);          // Fetch all admins
// Route::get('/admin/{id}', [AdminController::class, 'show']);      // Fetch a specific admin by ID
// Route::post('/admin', [AdminController::class, 'store']);         // Store a new admin
// Route::put('/admin/{id}', [AdminController::class, 'update']);    // Update an existing admin by ID
// Route::delete('/admin/{id}', [AdminController::class, 'destroy']); // Delete an admin by ID

//Cart Api Route
Route::post('/cart/add', [CartController::class, 'addToCart']);
route::get('/cart', [CartController::class, 'fetchCart']);
route::delete('/cart/delete', [CartController::class, 'deleteCartItem']);
