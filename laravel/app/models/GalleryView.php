<?php

class GalleryView extends Eloquent {
    
    public function thread()
    {
        return $this->belongsToMany('Gallery', 'gallery_id');
    }


    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'gallery_views';

}

?>