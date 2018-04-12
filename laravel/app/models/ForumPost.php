<?php

class ForumPost extends Eloquent {
    
    public function thread()
    {
        return $this->belongsTo('ForumThread', 'thread_id');
    }
    
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'forum_posts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    
    
}

?>