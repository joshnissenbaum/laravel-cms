<?php

class ArticleCategory extends Eloquent {
    
    public function article()
    {
        return $this->hasMany('Article', 'id');
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'article_categories';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
        
    
}

?>