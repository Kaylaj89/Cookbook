<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Author extends Model
{
    use HasFactory, Searchable;

    public function recipes(){
    	return $this->hasMany(Recipe::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function team(){
        return $this->belongsTo(Author::class);
    }

    public function searchableAs()
    {
        return 'authors_index';
    }

 public function toSearchableArray()
{
    return  $this->toArray();
}
}
