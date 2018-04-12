<?php

class UserBadge extends Eloquent {
    
    public function badge()
    {
        return $this->belongsTo('Badge', 'badge_id');
    }
    
     public function user()
    {
        return $this->belongsToMany('User', 'user_id');
    }

	protected $table = 'user_badges';

}

?>