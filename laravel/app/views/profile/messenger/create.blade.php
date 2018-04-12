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
          <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 18px;"><span class="glyphicon glyphicon-inbox"></span>&nbsp; Messages</h2>
                </header>
            </div>
        <p></p>
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error_message')}}
        </div>
    @endif        
    <div class="row">
    @if($username == Auth::user()->username)
    <div class="col-md-4">
        @include('profile.messenger.threads')
    </div> 
    @endif
    <div class="@if($username == Auth::user()->username) col-md-8 @else col-md-12 @endif">
     <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 16px;"><span class="glyphicon glyphicon-send"></span>&nbsp; Send a Message</h2>
                </header>
            </div>
    @if ($errors->has())
        <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>        
    @endforeach
    </div>
    @endif
    {{ Form::open(['route' => 'messages.store']) }}
        <div class="form-group">
            {{ Form::label('username', 'Username(s)', ['class' => 'control-label']) }}
            @if(isset($to))
                <input type="text" class="form-control" name="users" id="users" placeholder="John, Michael, Timmy" value="{{ $to }}">
            @else
                <input type="text" class="form-control" name="users" id="users" placeholder="John, Michael, Timmy" value="{{ Input::old('users')}}">
            @endif
        </div>
        <div class="alert alert-success"><span class="glyphicon glyphicon-bell"></span>&nbsp; You can start a group chat or just send a message to one user</div>
        <div class="form-group">
            {{ Form::label('message', 'Message', ['class' => 'control-label']) }}
            {{ Form::textarea('message', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Send Message', ['class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
    </div>
</div>
</div>
</div>
</div>
@stop