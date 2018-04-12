@extends('layouts.default')
@section('content')
<div class="profile">
    
    <div class="profile-cover-img" style="background-image: url('<?php echo asset($user->getPhoto($user->cover_photo)->large.'')?>');">
    <div class="profile-name">
       @include('profile.profile-name')
    </div> 
    </div>
    <div class="profile-inner">
        <div class="profile-img" style=" background-image: url('<?php echo asset($user->getPhoto($user->profile_photo)->mid.'')?>');"></div>
        <div class="profile-data">
             <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 16px;"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; Profile Info</h2></header>
            </div>
            <b>Join Date:</b> {{ $user->created_at->format('j F Y') }}<br>
            <b>Last Online:</b> {{ $user->updated_at->diffForHumans() }}<br>
            <b>Forum Posts:</b> {{ ForumPost::where('user_id', '=', $user->id)->count() }}<br>
            <b>Published Articles:</b> {{ Article::where('author_id', '=', $user->id)->count() }}<br>
            <p></p>
             <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 16px;"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; Contact Info</h2></header>
            </div>
            <?php
            if($user->privacy->email_public == 1)
            {
                echo'<b>Email Address:</b> '.$user->email.'<br>';
            }
            else
            {
                echo'<b>Email Address:</b> Hidden<br>';
            }
            ?>
            <?php
            if($user->privacy->website_public == 1)
            {
                echo'<b>Website:</b> <a target="_blank" href="'.$user->website.'"> '.$user->website.'</a><br>';
            }
            else
            {
                echo'<b>Website:</b> Hidden<br>';
            }
            ?>
            
            <div class="badges">
              @foreach (UserBadge::where('user_id', '=', $user->id)->get() as $badge)
               <span class="label"  data-toggle="tooltip" data-placement="bottom" title="{{$badge->badge->description}}" style="background-color: {{$badge->badge->colour}}">{{ $badge->badge->name }}</span> 
              @endforeach
            </div>
            </div>
    </div>
</div>
@stop
