<?php

namespace App\Http\Livewire\Comments;

use Livewire\Component;
use App\Models\Recipe;
use App\Models\Comment;

class Show extends Component
{
	public $comments;
	public $comment;
	public $recipe;

	protected $rules = [
        'comment' => 'required|min:1|max:200',
    ];

	public function mount(Recipe $recipe){
		$this->recipe = $recipe; 
		$this->comments = $recipe->comments != null ? $recipe->timeline() : []; 
	}

	public function saveComment(){
	    $this->validate();
		$comment = new Comment();
		$user = auth()->user();
		$comment->user_id = $user->id;
		$comment->recipe_id = $this->recipe->id;
		$comment->content = $this->comment;
		$comment->save();
		$this->comments = $this->recipe->timeline();
		$this->comment = '';
	}
	public function deleteComment($id){
		$comment= Comment::find($id);
		$comment->delete();
		$this->comments = $this->recipe->timeline();		
	}

    public function render()
    {
        return view('livewire.comments.show');
    }
}