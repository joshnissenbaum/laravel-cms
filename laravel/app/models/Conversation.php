<?php

class Conversation extends Eloquent {
    
    // Define model relationships to 'Message' and 'Participant'
    //
    public function message()
    {
        return $this->hasMany('Message', 'convo_id');
    }    
    public function participant()
    {
        return $this->hasMany('Participant', 'convo_id');
    }    
    public function getLatestMessage()
    {
        return $this->message()->latest()->first();
    }    
    
    // Model public functions
    //
    
    // Retrieve conversations for a given userid
    public function scopeforUser($query, $userId)
    {
        return $query->join('participants', 'conversations.id', '=', 'participants.convo_id')
            ->where('participants.user_id', $userId)
            ->where('participants.deleted_at', null)
            ->select('conversations.*');
    }
    // Retrieve new messages in conversations for a given userid
    public function scopeuserNewMessages($query, $userId)
    {
        return $query->join('participants', 'conversations.id', '=', 'participants.convo_id')
            ->where('participants.user_id', $userId)
            ->whereNull('participants.deleted_at')
            ->where(function ($query) {
                $query->where('conversations.updated_at', '>', $this->getConnection()->raw($this->getConnection()->getTablePrefix() . 'participants.last_read'))
                    ->orWhereNull('participants.last_read');
            })
            ->select('conversations.*');
    }
    public function getParticipantFromUser($userId)
    {
        return $this->participant()->where('user_id', $userId)->firstOrFail();
    }
    public function markAsRead($userId)
    {
        try {
            $participant = $this->getParticipantFromUser($userId);
            $participant->last_read = new Carbon;
            $participant->save();
        } catch (ModelNotFoundException $e) {
            // do nothing
        }
    }
     public function isUnread($userId)
    {
        try {
            $participant = $this->getParticipantFromUser($userId);
            if ($this->updated_at > $participant->last_read) {
                return true;
            }
        } catch (ModelNotFoundException $e) {
            // do nothing
        }

        return false;
    }
    public function addParticipants(array $participants)
    {
        if (count($participants)) {
            foreach ($participants as $participant) {
                $partUser = new Participant;
                $partUser->user_id = $participant->id;
                $partUser->convo_id = $this->id;
                $partUser->save();
            }
        }
    }
    public function participantsUserIds($userId = null)
    {
        $users = $this->participants()->withTrashed()->lists('user_id');

        if ($userId) {
            $users[] = $userId;
        }

        return $users;
    }
	protected $table = 'conversations';
}

?>