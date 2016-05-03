<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * Article Belongs to an user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * write brief description
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Mutators
     * @param $title
     */
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = strtolower($title);
    }

    /**
     * Accessors.
     * @param $title
     * @return string
     */
    public function getTitleAttribute($title)
    {
        return strtoupper($title);
    }

    /**
     * Get the tags associated with given article.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Get a list of tag ids associated with current article.
     * @return
     * @internal param $id
     */
    public function getTagListAttribute()
    {

        return $this->tags->lists('id');
    }
}
