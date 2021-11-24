<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function posts(){
        return $this->belongsToMany('App\Models\Post');
    }

    public function filteredPosts(){
        return $this->belongsToMany('App\Models\Post')
        ->wherePivot('hashtag_id', $this->id)
        ->orderBy('updated_at', 'DESC');
    }
}
