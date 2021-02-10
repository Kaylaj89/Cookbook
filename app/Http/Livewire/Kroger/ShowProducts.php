<?php

namespace App\Http\Livewire\Kroger;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ShowProducts extends Component
{
	public $products;
	public $ingredients; 	

	public function loadKrogerProducts(){
		// $value = Cache::pull('kroger');
    //set cache time to 15 seconds for fast loading
		$this->products = Cache::remember('kroger', 15, function () {
		    $access_token = $this->krogerAuthorize();
			$products = [];
	        $index = 0; 
	        foreach ($this->ingredients as $ingredient) {
	            $product = $this->getKrogerProductData($access_token, $ingredient);//returns 0 if product not found
	            if($product != 0){
	                array_push($products, $product);
	            }
	        }
	        return $products; 
		});
	}
    public function render()
    {
        return view('livewire.kroger.show-products');
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