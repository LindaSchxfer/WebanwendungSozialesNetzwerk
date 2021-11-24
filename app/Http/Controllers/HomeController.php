<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $meldung_success = Session::get('meldung_success');

        $posts = Post::select()
        ->where('user_id', auth()->id())
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('home')->with(
            [
                'posts' => $posts,
                'meldung_success' => $meldung_success
            ]
        );
    }
}
