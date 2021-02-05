<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Author;
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
        $authors = Author::all();
       return view("recipes.create", ['authors'=>$authors]);
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
        $author = Author::find($request->author);
        if($author){
            $recipe->author_id = $author->id;
        }else{
            $recipe->author_id = null;
        }
        $recipe->description = $request->description;
        //split the ingredients by line and create json
        $ingredientByLine = explode(PHP_EOL, $request->ingredients)[0] == ''? null : json_encode(explode(PHP_EOL, $request->ingredients));
        $recipe->ingredients = $ingredientByLine;
        $stepsByLine = explode(PHP_EOL, $request->cooking_Directions)[0] == '' ? null : json_encode(explode(PHP_EOL, $request->cooking_Directions));
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
        $authors = Author::all();
        return view('recipes.edit', ['recipe'=>$recipe, 'ingredients' => $ingredients, 'steps'=>$steps, 'authors'=>$authors]);
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
        $author = Author::find($request->author);
        if($author){
            $recipe->author_id = $author->id;
        }else{
            $recipe->author_id = null;
        }
        $recipe->description = $request->description;
        //split the ingredients by line and create json
        $ingredientByLine = explode(PHP_EOL, $request->ingredients)[0] == ''? null : json_encode(explode(PHP_EOL, $request->ingredients));
        $recipe->ingredients = $ingredientByLine;
        $stepsByLine = explode(PHP_EOL, $request->cooking_Directions)[0] == '' ? null : json_encode(explode(PHP_EOL, $request->cooking_Directions));
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
        if($attachmentsArray != null ){
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
        $recipeAttachments = count(json_decode($recipe->attachments, true)) > 0 ? json_decode($recipe->attachments, true) : null;
        if($recipeAttachments != null){
            foreach ($recipeAttachments['fileNames'] as $key => $value) {
                if($key == $fileName){
                    unset($recipeAttachments['fileNames'][$key]);
                }
            }
        }
        $recipe->attachments = count($recipeAttachments['fileNames'] )<= 0 ? null : json_encode($recipeAttachments);
        $recipe->save();
        if (Storage::disk('public')->exists('uploads/images/'. $fileName)) {
            Storage::disk('public')->delete('uploads/images/'. $fileName);
        }
        return back()->withInput();
    }
}