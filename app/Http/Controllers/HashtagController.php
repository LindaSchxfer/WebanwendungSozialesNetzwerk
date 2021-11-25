<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Illuminate\Http\Request;

class HashtagController extends Controller
{

    //was der User im nicht eingeloggten Zustand machen kann
    public function __construct(){

        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hashtags = Hashtag::all();
        return view('hashtag.index')->with('hashtags',$hashtags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hashtag.create');
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
                'color' => 'required',
            ]
        );

        $hashtag = new Hashtag(
            [
                'name' => $request['name'],
                'color' => $request['color'],
            ]
        );
        $hashtag->save();
        
        return $this->index()->with([
            'meldung_success' => 'Dein Hashtag <b>' . $hashtag->name . '</b> wurde erfolgreich angelegt.'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function edit(Hashtag $hashtag)
    {
        return view('hashtag.edit')->with('hashtag',$hashtag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hashtag $hashtag)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'color' => 'required',
            ]
        );

        $hashtag->update([
            'name' => $request->name,
            'color' => $request->color
        ]);
        return $this->index()->with([
            'meldung_success' => 'Dein Hashtag <b>' . $request->name . '</b> wurde erfolgreich bearbeitet.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hashtag $hashtag)
    {
        $old_name = $hashtag->name;
        $hashtag->delete();
        return $this->index()->with([
            'meldung_success' => 'Dein Hashtag <b>' . $old_name . '</b> wurde erfolgreich gelöscht.'
        ]);
    }
}
