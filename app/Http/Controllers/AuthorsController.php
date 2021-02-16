<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorsController extends Controller
{
 public function __construct()
    {
        $this->authorizeResource(Author::class, 'author');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $authors = Author::all()->where('team_id', '=', $user->currentTeam->id);
        return view('authors.index', ['authors'=>$authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $author = new Author();
        $author->team_id = $user->currentTeam->id;
        $author->name = $request->name;
        $author->bio = $request->bio;
        $author->user_id = $user->id;
        $this->updateAuthorPhoto($author, $request);
        $author->save();
        return $this->index();
        return redirect('authors')->with('flash.banner', 'A new author was created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('authors.show', ['author'=>$author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.edit', ['author'=>$author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $author->name = $request->name;
        $author->bio = $request->bio;
        $this->updateAuthorPhoto($author, $request);
        if ($author->save()){
            $request->session()->flash('flash.banner', 'Author was updated');
            $request->session()->flash('flash.bannerStyle', 'success');
        };
        return redirect('authors/'.$author->id)->with('flash.banner', 'Author updated successfully.');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {

    //delete author photo
    Storage::disk('public')->delete($author->photo);
    $author->delete();
    return redirect('authors')->with('flash.banner', 'Author deleted successfully.');
    }

    public function updateAuthorPhoto(Author $author, Request $request){         
        if($request->hasFile('author_photo'))
        {
            if($author->photo != null){
                //delete author photo
                Storage::disk('public')->delete($author->photo);
            }
            $file = $request->file('author_photo'); 
            $author->photo = str_replace('public', 'storage', $file->store('public/uploads/images/authors'));
        }
    }



}