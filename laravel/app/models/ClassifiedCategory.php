<?php

class ClassifiedCategory extends Eloquent {
    
    public function classified()
    {
        return $this->hasMany('Classified', 'id');
    }

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */


	protected $table = 'classifieds_categories';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
        
    
}

?>