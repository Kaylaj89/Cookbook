<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $recipes = Recipe::all();
        return view('recipes.index', ['recipes'=>$recipes]);
        // if ($recipe) 
        // {
        // $recipes  = Recipe::all();
        // return view('recipes.index', ['recipes'=>$recipes]);
        // }

        // else
        // {
        //     return "no recipes yet!";
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("recipes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = new Recipe();
        $recipe->name = $request->name;
        $recipe->description = $request->description; 
        //split ingredients by line so that can create json
        $ingredientByLine = json_encode(explode(PHP_EOL, $request->ingredients));
        $recipe->ingredients = $ingredientByLine;
        $stepsByLine = json_encode(explode(PHP_EOL, $request->cooking_Directions));
        $recipe->steps = $stepsByLine;
        $recipe->save();
        return redirect('/recipes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $ingredients = [];
        if(!empty($recipe->ingredients)){
            $ingredients = json_decode($recipe->ingredients);
        }
        $steps = [];
        if(!empty($recipe->steps)){
            $steps = json_decode($recipe->steps);
        }
        return view('recipes.show', ['recipe'=>$recipe, 'ingredients' => $ingredients, 'steps'=> $steps]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $ingredients = [];
        if(!empty($recipe->ingredients)){
          $ingredients = json_decode($recipe->ingredients);
        }
        $steps = [];
        if(!empty($recipe->steps)){
            $steps = json_decode($recipe->steps);
        }
        return view('recipes.edit', ['recipe'=>$recipe, 'ingredients' => $ingredients, 'steps'=>$steps]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->name = $request->name;
        $recipe->description = $request->description;
        //split the ingredients by line and create json
        $ingredientByLine = json_encode(explode(PHP_EOL, $request->ingredients));
        $recipe->ingredients = $ingredientByLine;
        $stepsByLine = json_encode(explode(PHP_EOL, $request->cooking_Directions));
        $recipe->steps = $stepsByLine;
        //$recipe->privacy = isset($request->privacy)?? ;
        $recipe->save();  
        return $this->show($recipe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/recipes');
    }
}
