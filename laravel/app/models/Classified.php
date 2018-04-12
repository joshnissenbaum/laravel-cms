<?php

class Classified extends Eloquent {
    
    public function category()
    {
        return $this->belongsTo('ClassifiedCategory', 'category_id');
    }
    public function photo()
    {
        return $this->hasMany('ClassifiedPhoto', 'classified_id');
    }
    public function owner()
    {
        return $this->belongsTo('User', 'user_id');
    }
    public function dblocation()
    {
        return $this->belongsTo('Location', 'location');
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'classifieds';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    
     public function scopegetPhoto($query, $id)
    {
        $classphoto = ClassifiedPhoto::where('classified_id', '=', $id)->first();
        $photo = Photo::find($classphoto->photo_id);
        return $photo;
    }
    
        
    
    
}

?>