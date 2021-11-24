<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hashtag;

class HashtagPostController extends Controller
{
    public function getFilteredPosts($hashtag_id){

        //echo "filtern nach tg_id: " . $hashtag_id;
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
}
