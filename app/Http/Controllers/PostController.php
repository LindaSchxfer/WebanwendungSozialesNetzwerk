<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::paginate(10);
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('post.index')->with('posts',$posts);
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
        return $this->index()->with([
            'meldung_success' => 'Dein Post <b>' . $post->name . '</b> wurde erfolgreich angelegt.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show')->with('post',$post);
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
        return $this->index()->with([
            'meldung_success' => 'Dein Post <b>' . $old_name . '</b> wurde erfolgreich gelöscht.'
        ]);
    }
}
