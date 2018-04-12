<?php
    $conversations = Conversation::forUser(Auth::user()->id)->latest('updated_at')->get();
?>
@if($conversations->count() == 0)
    <div class="alert alert-info">
    <span class="glyphicon glyphicon-info-sign"></span>&nbsp; You have not sent or recieved any messages yet.</div>
@endif
@foreach($conversations as $convo)
 <a class="message-thread" href="{{ URL::route('messages.show', ['username' => $user->username, 'id' => $convo->id])}}">
    <div class="media" @if(isset($convo_id) && $convo_id == $convo->id) style="background-color: #337ab7; padding: 10px; " @else style="padding: 10px; background-color: #CACACA;" @endif >
      <div class="media-left">
          <span class="glyphicon glyphicon-comment"></span>
      </div>
      <div class="media-body">
         <h4 class="media-heading" style="font-size: 16px;">
         @foreach($convo->participant as $participant)
             @if($participant->user->id != Auth::user()->id)
                @if($convo->participant->count() > 2)
                 {{ $participant->user->username }},
                 @else
                 {{ $participant->user->username }}
                 @endif
             @endif
         @endforeach
        </h4>
        <span class="last-sent" style="font-size: 14px;">{{ Str::limit($convo->getLatestMessage()->body, 100) }}</span>
        <span class="date-sent" style="display: block; font-size: 13px; margin-top: 5px;"><span class="glyphicon glyphicon-time"></span>&nbsp; {{ $convo->getLatestMessage()->created_at->diffForHumans() }}</span>
      </div>
    </div>
</a>
<hr style="margin-top: 5px; margin-bottom: 5px;">
@endforeach
