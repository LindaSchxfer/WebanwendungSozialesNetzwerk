<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hashtag;
use App\Models\Post;

class HashtagPostController extends Controller
{
    public function getFilteredPosts($hashtag_id){

        $hashtag = new Hashtag();

        $filter = $hashtag::findOrFail($hashtag_id);

        $filteredPosts = $filter->filteredPosts()->paginate(10);
        
        return view('post.filteredByHashtag')->with(
            [
            'posts' => $filteredPosts,
            'hashtag' => $filter
            ]
        );
    }

    public function attachHashtag($post_id, $hashtag_id){

        $post = Post::find($post_id);
        $hashtag = Hashtag::find($hashtag_id);
        $post->hashtags()->attach($hashtag_id); 

        return back()->with('meldung_success', 'Der Hashtag <b>' .$hashtag->name. '</b> wurde deinem Post hinzugefügt.');
    }

    public function detachHashtag($post_id, $hashtag_id){
        
        $post = Post::find($post_id);
        $hashtag = Hashtag::find($hashtag_id);
        $post->hashtags()->detach($hashtag_id);
        
        return back()->with('meldung_success', 'Der Hashtag <b>' .$hashtag->name. '</b> wurde von deinem Post entfernt.');
    }

}
