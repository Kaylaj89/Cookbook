<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //split the ingredients by line and create json
        $ingredientByLine = json_encode(explode(PHP_EOL, $request->ingredients));
        $recipe->ingredients = $ingredientByLine;
        $stepsByLine = json_encode(explode(PHP_EOL, $request->cooking_Directions));
        $recipe->steps = $stepsByLine;
        //do attachments here 
        $this->updateAttachments($recipe, $request);
        //$recipe->privacy = isset($request->privacy)?? ;
        $recipe->save();  
        return $this->show($recipe);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
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
        return view('recipes.show', ['recipe'=>$recipe, 'ingredients' => $ingredients, 'steps'=>$steps]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
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
     * @param  \App\Models\Recipe  $recipe
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
        $this->updateAttachments($recipe, $request);
       //$recipe->privacy = isset($request->privacy)?? ;
        $recipe->save();  
        return $this->show($recipe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $this->deleteOldAttachments($recipe);
        $recipe->delete();
        return redirect('/recipes');
    }

    public function deleteOldAttachments(Recipe $recipe){
        $attachmentsArray = json_decode($recipe->attachments, true);
        if(count($attachmentsArray['fileNames']) > 0){
         foreach($attachmentsArray['fileNames'] as $fileName => $originalName){
                Storage::disk('public')->delete('uploads/images/'. $fileName);
            }
            $recipe->attachments = null;
        }
    }
    public function updateAttachments(Recipe $recipe, Request $request){         
        if($request->hasFile('attachments'))
        {
            $filesArray = $request->file('attachments'); 
            $filesJson = [];
            $filesJson['count'] = count($filesArray);
            $fileNamesArray= [];
            foreach ($filesArray as $file) {
                //unique key with original filename as value
                $fileNamesArray[$file->hashName()]= $file->getClientOriginalName();
                $file->store('public/uploads/images');
            }
            $filesJson['fileNames'] = $fileNamesArray;
            $recipe->attachments = json_encode($filesJson);
        }
    }

    public function deleteAttachment(Request $request, Recipe $recipe, $fileName){
        $recipeAttachments = json_decode($recipe->attachments, true);
        foreach ($recipeAttachments['fileNames'] as $key => $value) {
            if($key == $fileName){
                unset($recipeAttachments['fileNames'][$key]);
            }
        }
        $recipe->attachments = $recipeAttachments;
        $recipe->save();
        if (Storage::disk('public')->exists('uploads/images/'. $fileName)) {
            Storage::disk('public')->delete('uploads/images/'. $fileName);
        }
        return back()->withInput();
    }
}