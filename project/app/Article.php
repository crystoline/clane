<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content'
    ];

    /**
     * @return HasMany
     */
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
