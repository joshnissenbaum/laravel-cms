<?php

class ForumThread extends Eloquent {
    
    public function post()
    {
        return $this->hasMany('ForumPost', 'thread_id');
    }
    
    public function category()
    {
        return $this->belongsTo('ForumCategory', 'category_id');
    }
    
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }
    public function view()
    {
        return $this->hasMany('ForumThreadView', 'thread_id');
    }
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'forum_threads';
    
    public function scopeTrendingPosts($query)
    {
          $trending = ForumThread::select(DB::raw('forum_threads.*, count(*) as `aggregate`'))
        ->join('forum_thread_views', 'forum_threads.id', '=', 'forum_thread_views.thread_id')
        ->where('forum_thread_views.created_at', '>=', Carbon::now()->subHours(48))
        ->groupBy('forum_threads.id')
        ->orderBy('aggregate', 'desc');
        return $trending;
    }
    public function scopeLastReply($query, $id)
    {
        $lastreply = ForumPost::where('thread_id', '=', $id)->orderBy('created_at', 'DESC')->first();
        return $lastreply;
    }
    public function scopegetPhoto($query, $id)
    {
        $photo = Photo::find($id);
        return $photo;
    }

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

        
    
}

?>