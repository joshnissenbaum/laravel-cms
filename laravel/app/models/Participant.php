<?php

class Participant extends Eloquent {
    
    public function user()
    {
        return $this->belongsTo('User');
    }
    public function conversation()
    {
        return $this->belongsToMany('Conversation');
    }
	protected $table = 'participants';
}

?>