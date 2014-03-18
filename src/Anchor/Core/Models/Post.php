<?php

namespace Anchor\Core\Models;

use Anchor\Core\Services\ValidationException;
use Eloquent;
use Validator;
use Lang;

class Post extends Eloquent
{
    protected $guarded = array();
    protected $translations = 'core::posts';

    protected $original = array(
        'author' => 1, // by default assign to author admin?
        'comments' => false
    );

    protected $rules = array(
        'title' => 'required',
        'slug'  => 'required|alpha_dash|unique:posts'
    );

    public function isValid()
    {
        $validation = Validator::make($this->attributes, $this->rules, Lang::get($this->translations));

        if ($validation->fails()) throw new ValidationException($validation->messages());

        return true;
    }


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
