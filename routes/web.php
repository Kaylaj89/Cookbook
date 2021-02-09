<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController; 
use App\Http\Controllers\AuthorsController; 
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ShoppingListsController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resources([
    'recipes' => RecipesController::class,
    'authors' => AuthorsController::class,
    ]);

Route::post('/recipes/{recipe}/{fileName}', [RecipesController::class, 'deleteAttachment'])->name('recipes.attachment.delete');
Route::post('/comments', [CommentsController::class, 'store'])->name('comment.save');
Route::get('/shoppinglist', [ShoppingListsController::class, 'show'])->name('shoppingList.show');
Route::patch('/shoppinglist', [ShoppingListsController::class, 'update']);
Route::post('/shoppinglist', [ShoppingListsController::class, 'delete'])->name('shoppinglist.delete');



