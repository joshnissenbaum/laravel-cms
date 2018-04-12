<?php

class Message extends Eloquent {
    
    public function conversation()
    {
        return $this->belongsToMany('Conversation');
    }
    public function user()
    {
        return $this->belongsTo('User');
    }
	protected $table = 'messages';
}

?>