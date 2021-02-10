<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController; 
use App\Http\Controllers\AuthorsController; 
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ShoppingListsController;
use App\Models\Recipe;


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
    $total_transcriptions_needed= count(Recipe::all()->where('needs_transcription', '=','1' ));
    return view('dashboard')->with(['total_transcriptions_needed'=>$total_transcriptions_needed]);
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/recipes/needstranscription', function () {
    $recipes_that_need_transcription= Recipe::all()->where('needs_transcription', '=','1' );
    return view('recipes.needstranscription')->with(['recipes'=>$recipes_that_need_transcription]);
})->name('recipes.needstranscription');

Route::resources([
    'recipes' => RecipesController::class,
    'authors' => AuthorsController::class,
    ]);

Route::post('/recipes/{recipe}/{fileName}', [RecipesController::class, 'deleteAttachment'])->name('recipes.attachment.delete');
//Route::post('/comments', [CommentsController::class, 'store'])->name('comment.save');Route::get('/shoppinglist', [ShoppingListsController::class, 'show'])->name('shoppingList.show');
Route::get('/shoppinglist', [ShoppingListsController::class, 'show'])->name('shoppingList.show');
Route::patch('/shoppinglist', [ShoppingListsController::class, 'update']);
Route::post('/shoppinglist', [ShoppingListsController::class, 'delete'])->name('shoppinglist.delete');


