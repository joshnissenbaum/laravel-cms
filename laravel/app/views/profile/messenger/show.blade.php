@extends('layouts.default')
@section('content')
<?php
$user = User::where('username', '=', $username)->first();
$conversation = Conversation::find($convo_id);
?>
<div class="profile">
    <div class="profile-cover-img" style="background-image: url('<?php echo asset($user->getPhoto($user->cover_photo)->large.'')?>');">
    <div class="profile-name">
       @include('profile.profile-name')
    </div> 
    </div>
     <div class="profile-inner">
    <div class="profile-data" style="padding-left: 0; padding-right: 0;">
        <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 18px;"><span class="glyphicon glyphicon-inbox"></span>&nbsp; Messages</h2>
                @if($user->id == Auth::user()->id)
                    <a href="{{ URL::route('messages.create', array('username' => $username))}}"><button class="btn btn-primary" type="button" style="position: absolute; right: 0;">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp; New Message</button></a>
                @endif
                </header>
            </div>
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error_message')}}
        </div>
    @endif
        
    <div class="row">
    <div class="col-md-4">
        @include('profile.messenger.threads')
    </div> 
    <div class="col-md-8" id="convoMessages">
        <div class="messages-wrapper" style="height: 25em; overflow: auto;">
         @if($messages->count() > 6) 
            <button type="button" id="seeMoreMessages" class="btn btn-primary"><span class="glyphicon glyphicon-share-alt"></span>&nbsp; View More</button><p></p>
        @endif
        <div class="messages-inner">
        @foreach($messages->reverse() as $message)
            <div class="media" style="padding: 5px;">
              <div class="media-left">
                 <a href="{{ URL::route('profile', ['username' => $message->user->username])}}">
                  <img class="media-object img-circle" width="50" height="50" src="{{ asset($message->user->getPhoto($message->user->profile_photo)->thumb) }}" alt="..."></a>
              </div>
              <div class="media-body">
                <a href="{{ URL::route('profile', ['username' => $message->user->username])}}"><h4 class="media-heading">{{ $message->user->username }} <span style="float: right; color: rgb(115, 115, 115); font-size: 14px;">{{ $message->created_at->diffForHumans() }}</span></h4></a>
                {{ nl2br($message->body) }}
             
                
              </div>
            </div>
            <p></p><hr><p></p>
        @endforeach
        </div>
        </div>
       
  
        @if ($errors->has())
        <div class="alert alert-danger" id="errorMessage">
            @foreach ($errors->all() as $error) {{ $error }}
            <br> @endforeach
        </div>
        <p></p>
        @endif
        {{ Form::open(['id' => 'send-msg', 'route' => 'messages.reply']) }}
        {{ Form::hidden('convo', $convo_id) }}
        <textarea class="form-control" name="body" id="body" placeholder="Send a message..."></textarea>
        <p></p>
        <div class="row">
        @foreach($conversation->participant as $participant)
            @if($participant->user_id != Auth::user()->id && $participant->last_read != null)
            <a href="{{ URL::route('profile', ['username' => $participant->user->username])}}">
             <div class="col-md-4">
            <img src="{{ asset($participant->user->getPhoto($participant->user->profile_photo)->mid) }}" class="img-responsive img-thumbnail">
         <div class="alert alert-info">
            <span class="glyphicon glyphicon-eye-open"></span>&nbsp; Seen</a>
            &middot; {{ Carbon::parse($participant->last_read)->diffForHumans() }}<br/>
              </div>
                  </div>
            </a>
            @endif
        @endforeach
        
        </div>
        {{ Form::close() }}
        <?php $conversation->markAsRead(Auth::user()->id); ?>
    </div>
</div>
</div>
</div>
</div>
<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
<script>
    $(".messages-wrapper").animate({ scrollTop: $('.messages-wrapper').prop("scrollHeight")}, 0);
    var sending = false;
    Pusher.logToConsole = true;

    var pusher = new Pusher('da9dfe71098e7b5e7d2c', {
        encrypted: true,
        cluster: "ap1"
    });
    var channel = pusher.subscribe('messagesConvo');
    channel.bind('{{ $convo_id }}', function (data) {
        //console.log(data);
        $(".messages-wrapper").animate({ scrollTop: $('.messages-wrapper').prop("scrollHeight")}, 200);
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', '{{ asset("sounds/message.mp3")}}');
        audioElement.setAttribute('autoplay', 'autoplay');
        $.get();
        audioElement.addEventListener("load", function() {
            audioElement.play();
        }, true);
        var html = `<div class="media" style="padding: 5px;">
              <div class="media-left">

                  <img class="media-object img-circle" width="50" height="50" src="` + data.userPhoto +`" alt="...">
              </div>
              <div class="media-body">
                <a href="#"><h4 class="media-heading">` + data.user +`<span style="float: right; color: rgb(115, 115, 115); font-size: 14px;">` + data.createdAt + `</span></h4></a>
                ` + data.body +`
              </div>
            </div>
            <p></p><hr><p></p>`;
        $(html).hide().appendTo(".messages-wrapper").fadeIn(1000);

    });
</script>
<script type="text/javascript">
    $('textarea#body').keypress(function (e) {
  if (e.which == 13 && sending == false) {
    sending = true;
    $('form#send-msg').submit();
    return false;    //<---- Add this line
  }
});
    $("#send-msg").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ URL::route("messages.reply") }}'
            , type: 'post'
            , dataType: 'json'
            , data: $('form#send-msg').serialize()
            , success: function (data) {
                console.log(data);
                $('textarea#body').val('');
                sending = false;



            }
            , error: function (data) {
                console.log(data);
            }
        });
    });
</script>


<script>
    var page = 2;
    $('#seeMoreMessages').click(function (e) {
        e.preventDefault();
        $.ajax({
            url : '{{ Request::url() }}' + '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $(data)
                .prependTo('.messages-inner')
                .hide().fadeIn(1000);
            page++;
        }).fail(function () {
            $("#seeMoreMessages").hide();
        }); 
    });
</script>
@stop