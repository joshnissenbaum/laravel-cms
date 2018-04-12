<?php

class ForumThreadView extends Eloquent {
    
    public function thread()
    {
        return $this->belongsToMany('ForumThread', 'thread_id');
    }


    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'forum_thread_views';

}

?>