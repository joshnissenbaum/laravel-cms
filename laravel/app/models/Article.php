<?php

class Article extends Eloquent {
    
    public function body()
    {
        return $this->hasOne('ArticleBody', 'article_id');
    }
    
    public function author()
    {
        return $this->belongsTo('User', 'author_id');
    }
    
    public function view()
    {
        return $this->hasMany('ArticleView', 'article_id');
    }
    
    public function category()
    {
        return $this->belongsTo('ArticleCategory', 'category_id');
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'articles';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    
    public function scopeMostViewedArticles($query)
    {
        $views = Article::select(DB::raw('articles.*, count(*) as `aggregate`'))
        ->join('article_views', 'articles.id', '=', 'article_views.article_id')
        ->groupBy('article_id')
        ->orderBy('aggregate', 'desc');
        return $views;
    }
    
    public function scopeTrendingArticles($query)
    {
         $trending = Article::select(DB::raw('articles.*, count(*) as `aggregate`'))
        ->join('article_views', 'articles.id', '=', 'article_views.article_id')
        ->where('article_views.created_at', '>=', Carbon::now()->subHours(48))
        ->groupBy('article_id')
        ->orderBy('article_views.created_at', 'asc');
        return $trending;
    }
    public function scopegetPhoto($query, $id)
    {
        $photo = Photo::find($id);
        return $photo;
    }
        
    
}

?>