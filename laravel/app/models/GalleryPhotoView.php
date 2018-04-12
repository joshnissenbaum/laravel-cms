<?php

class GalleryPhotoView extends Eloquent {
    
    public function thread()
    {
        return $this->belongsToMany('GalleryPhoto', 'gallery_id');
    }


    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'gallery_photo_views';

}

?>