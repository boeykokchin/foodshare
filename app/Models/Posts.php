<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Posts extends Model
{
    // restrict columns from modifying
    protected $guarded = [];

    // posts has many comments
    // returns all comments on that post
    public function comments()
    {
        return $this->HasMany('App\Models\Comments', 'on_post');
    }

    // returns the instance of the user who us author of that post
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    use HasFactory;
}
