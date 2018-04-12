<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use SammyK\LaravelFacebookSdk\FacebookableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
    use FacebookableTrait;
    
    public function privacy()
    {
        return $this->hasOne('Privacy');
    }
    
    public function article()
    {
        return $this->hasMany('Article');
    }
    
    public function forumthread()
    {
        return $this->hasMany('ForumThread', 'id');
    }
    
    public function badge()
    {
        return $this->hasMany('UserBadge');
    }   
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
	protected $table = 'users';
    
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token', 'access_token');
    
    public function scopegetPhoto($query, $id)
    {
        $photo = Photo::find($id);
        return $photo;
    }
    
    
}

?>