<?php

namespace App\Http\Livewire\Kroger;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ShowLocations extends Component
{

	public $zip; 
    public $locations = [];
	protected $rules = [
        'zip' => 'required|digits:5',
    ];

	public function mount(Request $request){
		$ip = $request->ip();
        $location = \Location::get($ip);
        $this->zip = is_object($location) ? $location->zipCode : '98087';
	}

	public function updated(){
		$this->validate();
        $this->loadKrogerLocations();
	}

    public function render()
    {
        return view('livewire.kroger.show-locations');
    }

    public function loadKrogerLocations(){
		// $value = Cache::pull('kroger-locations');
		$this->locations = Cache::remember('kroger-locations', 7, function () {
		    $access_token = $this->krogerAuthorize();
			 $locations = $this->getKrogerLocationData($access_token);//returns 0 if product not found  
            // dd($locations);
	        return $locations; 
		});
	}
    //all kroger api helper methods are here
    protected function getKrogerLocationData($access_token){
        $url = "https://api-ce.kroger.com/v1/locations?filter.zipCode.near={$this->zip}&filter.chain=fred&filter.limit=3";
        $headers = array(
            "Accept" =>"application/json",
        );
        $response = Http::withToken($access_token)->withHeaders($headers)->get($url);
        $data = json_decode($response, true)['data'];
        if(count($data) <= 0){
            return 0;
        }   
        return $data;
    }
    protected function krogerAuthorize(){
        $url = "https://api-ce.kroger.com/v1/connect/oauth2/token";
        $headers = array(
            "Authorization" => "Basic " . env('KROGER_API_SECRET'),
        );
        $data = array("grant_type" => "client_credentials", "scope" => "product.compact");
        $response = Http::asForm()->withHeaders($headers)->post($url, $data);
        return json_decode($response, true)['access_token'];
    }
}