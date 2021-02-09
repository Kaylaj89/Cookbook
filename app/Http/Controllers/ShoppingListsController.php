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
        $access_token = $this->krogerAuthorize();
        $user = auth()->user();
        $ingredients = $user->shoppingList->ingredients == null ? [] : json_decode($user->shoppingList->ingredients, true);
        $products = [];
        $index = 0; 
        foreach ($ingredients as $ingredient) {
            $product = $this->getKrogerProductData($access_token, $ingredient);//returns 0 if product not found
            if($product != 0){
                array_push($products, $product);
            }
        }
       // dd($products);
        return view('shoppinglists.show', ['ingredients'=>$ingredients, 'shoppinglist'=>$shoppingList, 'products' => $products]);    }

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
        return redirect('/shoppinglist');
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

     //all kroger api helper methods are here
     protected function getKrogerProductData($access_token, $ingredient){
        $url = "https://api-ce.kroger.com/v1/products?filter.term={$ingredient}&filter.limit=1";
        $headers = array(
            "Accept" =>"application/json",
        );
        $response = Http::withToken($access_token)->withHeaders($headers)->get($url);
        $data = json_decode($response, true)['data'];
        if(count($data) <= 0){
            return 0;
        }
        $product_id = $data[0]['productId'];
        $photo  = "https://www.kroger.com/product/images/small/front/{$product_id}";   
        $description = $data[0]['description'];
        $category = $data[0]['categories'][0];
        return ['photo'=>$photo, 'description'=>$description, 'category'=>$category];
    }
    protected function krogerAuthorize(){
        $url = "https://api-ce.kroger.com/v1/connect/oauth2/token";
        $headers = array(
            "Authorization" => 'Basic ' . config('services.kroger.key'),
        );
        $data = array("grant_type" => "client_credentials", "scope" => "product.compact");
        $response = Http::asForm()->withHeaders($headers)->post($url, $data);
        return json_decode($response, true)['access_token'];
    }
}