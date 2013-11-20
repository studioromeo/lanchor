<?php

namespace Anchor\Core\Models;

use Eloquent;

class Post extends Eloquent
{
    public $fillable = array(
        'title',
        'slug',
        'description',
        'html',
        'css',
        'js',
        'author',
        'category',
        'status',
        'comments'
    );

    public function category()
    {
        $this->belongsTo('Anchor\\Core\\Models\\Category');
    }
}
