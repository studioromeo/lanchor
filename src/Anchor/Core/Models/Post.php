<?php

namespace Anchor\Core\Models;

use Eloquent;

class Post extends Eloquent
{
    protected $guarded = array();

    public function category()
    {
        return $this->belongsTo('Anchor\\Core\\Models\\Category', 'category');
    }

    public function author()
    {
        return $this->belongsTo('Anchor\\Core\\Models\\User', 'author');
    }

    public function comments()
    {
        return $this->hasMany('Anchor\\Core\\Models\\Comment', 'post');
    }

    public function getAuthorNameAttribute()
    {
        return $this->author()->first()->real_name;
    }

    public function getAuthorIdAttribute()
    {
        return $this->author()->first()->id;
    }

    public function getAuthorBioAttribute()
    {
        return $this->author()->first()->bio;
    }
}
