<?php

class ArticleView extends Eloquent {
    
    public function article()
    {
        return $this->belongsToMany('Article', 'id');
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'article_views';

}

?>