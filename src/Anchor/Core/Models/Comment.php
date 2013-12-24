<?php

namespace Anchor\Core\Models;

use Eloquent;

class Comment extends Eloquent
{
    public $timestamps = false;

    protected $guarded = array();

    public function post()
    {
        $this->belongsTo('Anchor\\Core\\Models\\Post', 'post');
    }

    public function getDates()
    {
        return array('date');
    }
}
