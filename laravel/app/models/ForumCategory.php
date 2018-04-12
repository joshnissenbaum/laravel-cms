<?php

class ForumCategory extends Eloquent {
        
    public function thread()
    {
        return $this->hasMany('ForumThread', 'category_id');
    }
    
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'forum_categories';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    
    public function countPosts($id)
    {
        $count = ForumPost::leftJoin('forum_threads', 'thread_id', '=', 'forum_threads.id')->where('forum_threads.category_id', '=', $id)->count();
        return $count;
    }       
    
}

?>