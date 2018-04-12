<?php

class Gallery extends Eloquent {
    
    public function photo()
    {
        return $this->hasMany('GalleryPhoto', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'galleries';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    
    public function scopegetPhoto($query, $id)
    {
        $photo = Photo::find($id);
        return $photo;
    }
        
    public function scopegetTrending($query)
    {
         $trending = Gallery::select(DB::raw('galleries.*, count(*) as `aggregate`'))
        ->join('gallery_views', 'galleries.id', '=', 'gallery_views.gallery_id')
        ->where('gallery_views.created_at', '>=', Carbon::now()->subHours(48))
        ->groupBy('gallery_id')
        ->orderBy('aggregate', 'desc');
        return $trending;
    }
    
}

?>