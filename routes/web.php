<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ShoppingListsController;
use App\Http\Controllers\GeoLocationController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Actions\Fortify;
use App\Models\Team;
use App\Models\ShoppingList;
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
    return redirect('/login');
    //return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $currentTeam = auth()->user()->currentTeam;
    $total_transcriptions_needed= count(Recipe::all()->where('needs_transcription', '=','1' )->where('team_id', '=', $currentTeam->id));
    return view('dashboard')->with(['total_transcriptions_needed'=>$total_transcriptions_needed]);
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/recipes/needstranscription', function () {
    $currentTeam = auth()->user()->currentTeam;
    $recipes_that_need_transcription= Recipe::all()->where('needs_transcription', '=','1' )->where('team_id', '=', $currentTeam->id);
    return view('recipes.needstranscription')->with(['recipes'=>$recipes_that_need_transcription]);
})->name('recipes.needstranscription');

//resource model routes:
Route::resources([
    'recipes' => RecipesController::class,
    'authors' => AuthorsController::class,
]);

Route::post('/recipes/{recipe}/{fileName}', [RecipesController::class, 'deleteAttachment'])->name('recipes.attachment.delete');
Route::get('/shoppinglist', [ShoppingListsController::class, 'show'])->name('shoppingList.show');
Route::patch('/shoppinglist', [ShoppingListsController::class, 'update']);
Route::post('/shoppinglist', [ShoppingListsController::class, 'delete'])->name('shoppinglist.delete');
Route::get('get-address-from-ip', [GeoLocationController::class, 'index']);



Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->profile_photo_path  = $user->avatar;
            //$newUser->avatar_original = $user->avatar_original;           
            $newUser->save();
            auth()->login($newUser, true);

	        $newUser->ownedTeams()->save(Team::forceCreate([
	            'user_id' => $newUser->id,
	            'name' => explode(' ', $newUser->name, 2)[0]."'s Family",
	            'personal_team' => true,
	        ]));
	        $shoppingList = new ShoppingList();
	        $shoppingList->user_id = $newUser->id;
	        $shoppingList->ingredients = null;
	        $shoppingList->save();
	    }
        return redirect()->to('/dashboard');
});