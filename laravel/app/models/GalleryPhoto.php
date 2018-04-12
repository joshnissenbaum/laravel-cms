<?php

class GalleryPhoto extends Eloquent {
    
    public function gallery()
    {
        return $this->belongsTo('Gallery', 'gallery_id');
    }
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'gallery_photos';
    
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
    
    public function scopegetTrending($query)
    {
         $trending = GalleryPhoto::select(DB::raw('gallery_photos.*, count(*) as `aggregate`'))
        ->join('gallery_photo_views', 'gallery_photos.id', '=', 'gallery_photo_views.gallery_id')
        ->where('gallery_photo_views.created_at', '>=', Carbon::now()->subHours(48))
        ->groupBy('gallery_id')
        ->orderBy('aggregate', 'desc');
        return $trending;
    }
    
    
}

?>