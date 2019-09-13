<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['article_id','user_id','rate'];

    public function article(){
        return $this->belongsTo(Article::class);
    }
}
