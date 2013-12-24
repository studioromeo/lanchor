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

    public function comments()
    {
        return $this->hasMany('Anchor\\Core\\Models\\Comment', 'post');
    }
}
