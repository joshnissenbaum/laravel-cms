<?php

class ArticleBody extends Eloquent {
    
    public function article()
    {
        return $this->belongsTo('Article', 'body_id');
    }


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'article_body';

}

?>