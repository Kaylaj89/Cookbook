<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recipe;

class Trcheckbox extends Component
{
    public $needsTranscription = false;
    public $recipeId;

    // protected $rules = ['recipe' => []];

    public function mount($recipeId){
        $this->recipeId = $recipe->id;
        $recipe = Recipe::find($this->recipeId);
        $this->needsTranscription = $recipe->needs_transcription;
    }

    public function updated(){
        $recipe = Recipe::find($this->recipeId);
        $this->toggle($this->needsTranscription);
        $recipe->needs_transcription = $this->needsTranscription;
        $recipe->save();
        $this->needsTranscription =  $recipe->needs_transcription;
    }

    protected function toggle(bool $bool){
        $bool = $bool == 1 ? 1 : 0; 
    }

    public function render()
    {
        return view('livewire.trcheckbox');
    }
}
