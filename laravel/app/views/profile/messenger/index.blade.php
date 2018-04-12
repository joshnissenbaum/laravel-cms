@extends('layouts.default')
@section('content')
<?php $user = User::where('username', '=', $username)->first(); ?>
<div class="profile">
    <div class="profile-cover-img" style="background-image: url('<?php echo asset($user->getPhoto($user->cover_photo)->large.'')?>');">
    <div class="profile-name">
       @include('profile.profile-name')
    </div> 
    </div>
     <div class="profile-inner">
    <div class="profile-data" style="padding-left: 0; padding-right: 0;">
        <span>
        <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 18px;"><span class="glyphicon glyphicon-inbox"></span>&nbsp; Messages</h2>
                @if($user->id == Auth::user()->id)
                    <a href="{{ URL::route('messages.create', array('username' => $username))}}"><button class="btn btn-primary" type="button" style="position: absolute; right: 0;">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp; New Message</button></a>
                @endif
                </header>
            </div>
        </span><p></p>
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error_message')}}
        </div>
    @endif
        
    <div class="row">
    <div class="col-md-4">
        @include('profile.messenger.threads')
    </div> 
    <div class="col-md-8">
    @foreach(Conversation::forUser(Auth::user()->id)->latest('updated_at')->take(1)->get() as $convo)

    @endforeach
    
    </div>
</div>
</div>
</div>
</div>
@stop