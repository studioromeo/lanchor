<?php

namespace Anchor\Core\Models;

use Eloquent;

class Metadata extends Eloquent
{
    public $timestamps = false;
    public $guarded = array();
    public $table = 'meta';
    protected $primaryKey = 'key';

    public function key()
    {
        return str_replace('custom_', '', $this->key);
    }
}
