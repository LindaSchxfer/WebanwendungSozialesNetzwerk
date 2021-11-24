<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //Meldungen refreshen
        $meldung_success = Session::get('meldung_success');
        $meldung_hinweis = Session::get('meldung_hinweis');

        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('post.index')->with(
            [
                'posts' => $posts,
                'meldung_success' => $meldung_success,
                'meldung_hinweis' => $meldung_hinweis
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'beschreibung' => 'required|min:5',
            ]
        );

        $post = new Post(
            [
                'name' => $request['name'],
                'beschreibung' => $request['beschreibung'],
                'user_id' => auth()->id(),
            ]
        );
        $post->save();
        //return redirect('/post');
        /*return $this->index()->with([
            'meldung_success' => 'Dein Post <b>' . $post->name . '</b> wurde erfolgreich angelegt.'
        ]);*/
        return redirect('/post/' . $post->id)->with('meldung_hinweis', 'Bitte weise deinem Post ein oder mehrere Hashtags zu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //alle Hashtags 
        $allHashtags = Hashtag::all();
        //alle verwendeten Hashtags
        $usedHashtags = $post->hashtags;
        //alle noch verfügbaren Hashtags
        $availableHashtags = $allHashtags->diff($usedHashtags);

        //Meldungen refreshen
        $meldung_success = Session::get('meldung_success');
        $meldung_hinweis = Session::get('meldung_hinweis');

        return view('post.show')->with('post',$post)->with(
            [
                'post' => $post,
                'meldung_success' => $meldung_success,
                'meldung_hinweis' => $meldung_hinweis,
                'availableHashtags' => $availableHashtags
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'beschreibung' => 'required|min:5',
            ]
        );

        $post->update([
            'name' => $request->name,
            'beschreibung' => $request->beschreibung
        ]);
        return $this->index()->with([
            'meldung_success' => 'Dein Post <b>' . $request->name . '</b> wurde erfolgreich bearbeitet.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $old_name = $post->name;
        $post->delete();
        return back()->with([
            'meldung_success' => 'Dein Post <b>' . $old_name . '</b> wurde erfolgreich gelöscht.'
        ]);
    }
}
