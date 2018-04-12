<?php $count = 1; ?>
        @foreach($messages as $message)
            <div class="media" style="padding: 5px;">
              <div class="media-left">
                 <a href="{{ URL::route('profile', ['username' => $message->user->username])}}">
                  <img class="media-object img-circle" width="50" height="50" src="{{ asset($message->user->getPhoto($message->user->profile_photo)->thumb) }}" alt="..."></a>
              </div>
              <div class="media-body">
                <a href="{{ URL::route('profile', ['username' => $message->user->username])}}"><h4 class="media-heading">{{ $message->user->username }}</h4></a>
                {{ nl2br($message->body) }}
                <p></p>
                <span style="display: block; font-size: 15px;"><span class="glyphicon glyphicon-time"></span> {{ $message->created_at->diffForHumans() }}</span>
              </div>
            </div>
            <p></p><hr><p></p>
        <?php $count++; ?>
        @endforeach