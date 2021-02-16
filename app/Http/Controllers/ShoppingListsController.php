<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShoppingListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingList $shoppingList)
    {
        
        $user = auth()->user();
        $ingredients = $user->shoppingList->ingredients == null ? [] : json_decode($user->shoppingList->ingredients, true);
        return view('shoppinglists.show', ['ingredients'=>$ingredients]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $shoppingList = $user->shoppingList;
        $ingredients = [];
        if($shoppingList->ingredients != null){
            $ingredients = json_decode($shoppingList->ingredients , true);
        }
        foreach ($request->ingredients as $ingredient) {
           if($request->remove == 'true'){
            if (($key = array_search($ingredient, $ingredients)) !== false) {
                unset($ingredients[$key]);
            }
           }else{
            array_push($ingredients, $ingredient);
           }
        }
        $ingredients = array_unique($ingredients);
        $shoppingList->ingredients = json_encode($ingredients);
        $shoppingList->save();
        return redirect('shoppinglist')->with('flash.banner', 'Shopping list updated successfully');
    }

        public function delete(){
            auth()->user()->shoppingList->ingredients = null;
            auth()->user()->shoppingList->save();
            return redirect('/shoppinglist');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingList $shoppingList)
    {

    }
 
}