<?php

class Privacy extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

    public function user()
    {
        return $this->belongsTo('User');
    }
    
	protected $table = 'privacy_settings';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('email_public', 'email_friends','website_public', 'website_friends');
    

}

?>