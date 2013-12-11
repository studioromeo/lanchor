<?php

namespace Anchor\Core\Models;

use Eloquent;

class Post extends Eloquent
{
    protected $guarded = array();

    public function category()
    {
        $this->belongsTo('Anchor\\Core\\Models\\Category');
    }
}
