<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    //was der User im nicht eingeloggten Zustand machen kann
    public function __construct(){

        $this->middleware('auth')->except(['index', 'show']);
    }

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
                'bild' => 'mimes:jpg,bmp,png'
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

        if(auth()->guest()){
            abort(403); //wird rausgeschmissen
        }

        abort_unless($post->user_id === auth()->id() || auth()->user()->rolle === 'admin', 403); //Nur Admin und richtiger User dürfen bearbeiten

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
        abort_unless(Gate::allows('update', $post), 403); 
        
        $request->validate(
            [
                'name' => 'required|min:3',
                'beschreibung' => 'required|min:5',
                'bild' => 'mimes:jpg,bmp,png'
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
        //Ist der User überhaupt eingeloggt?
        if(auth()->guest()){
            abort(403); //wird rausgeschmissen
        }

        //Hat der User das Recht zu löschen?
        abort_unless(Gate::allows('delete', $post), 403); 
        
        $old_name = $post->name;
        $post->delete();
        return back()->with([
            'meldung_success' => 'Dein Post <b>' . $old_name . '</b> wurde erfolgreich gelöscht.'
        ]);
    }
}
