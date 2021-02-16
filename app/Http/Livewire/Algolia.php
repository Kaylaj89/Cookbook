<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recipe;
use App\Models\Author;

class Algolia extends Component
{
	public $search;
	public $results;

	public function mount(){
		$this->search = '';
		$this->results = ['authors'=>[], 'recipes'=>[]];
	}


	public function updated(){
		if(strlen($this->search) > 0){
			$currentTeam = auth()->user()->currentTeam;
			$authors = Author::search($this->search)->where('team_id', $currentTeam->id)->get();
			$recipes = Recipe::search($this->search)->where('team_id', $currentTeam->id)->get();
			$this->results = ['authors'=>$authors, 'recipes' => $recipes];
		}else{
			$this->search = '';
			$this->results = ['authors'=>[], 'recipes'=>[]];
		}
	}
    public function render()
    {
        return view('livewire.algolia');
    }
}