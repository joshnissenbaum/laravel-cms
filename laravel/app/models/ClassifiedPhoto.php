<?php

class ClassifiedPhoto extends Eloquent {
    
    public function classified()
    {
        return $this->hasMany('Classified', 'id');
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'classifieds_photos';

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
        
    
}

?>