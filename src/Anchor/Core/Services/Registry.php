<?php

namespace Anchor\Core\Services;

use Illuminate\Cache\ArrayStore;

class Registry extends ArrayStore
{

    public function get($key, $default = null)
    {
        return parent::get($key) ?: $default;
    }

    public function prop($object, $key, $default = null)
    {
        return isset($this->get($object)->$key) ? $this->get($object)->$key : $default;
    }

    public function set($key, $value)
    {
        parent::put($key, $value, 0);
    }

    public function has($key)
    {
        return array_key_exists($key, $this->storage);
    }

}
