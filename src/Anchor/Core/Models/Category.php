<?php

namespace Anchor\Core\Models;

use Eloquent;

class Category extends Eloquent
{
    public $timestamps = false;

    public $fillable = array(
        'title',
        'slug',
        'description'
    );

    public function posts()
    {
        return $this->hasMany('Anchor\\Core\\Models\\Post', 'category');
    }
}
