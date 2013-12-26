<?php

namespace Anchor\Core\Models;

use Eloquent;

class Extend extends Eloquent
{
    public $timestamps = false;

    protected $table = 'extend';

    protected $guarded = array();

    public function getAttributesAttribute($value)
    {
        return json_decode($value);
    }

    public function setAttributesAttribute($value)
    {
        $value = $this->filterAttributes($value);
        $value = empty($value) ? '' : json_encode($value);

        return $this->attributes['attributes'] = $value;
    }

    protected function filterAttributes(array $value)
    {
        foreach ($value as $key => $val) {
            if (is_array($val)) {
                $value[$key] = $this->filterAttributes($val);
            }
        }

        return array_filter($value);
    }
}
