<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $appends =['avg_rating'];
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

    public function getAvgRatingAttribute(){
        $rating_count = $this->ratings()->count();
        $rating_total =  $this->ratings()->sum('rate')?? 0;
        return $rating_count > 0 ? round($rating_total / $rating_count, 2): 0;
    }

}
