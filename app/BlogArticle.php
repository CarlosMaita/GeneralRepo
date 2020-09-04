<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    protected $fillable = ['title', 'content', 'picture', 'keywords', 'autor_id', 'category_id', 'date'];


    public function author()
    {
    	return $this->belongsTo('App\User', 'autor_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\BlogCategorie', 'category_id');
    }

    public function comments()
    {
    	return $this->hasMany('App\BlogComment', 'article_id');
    }
}
