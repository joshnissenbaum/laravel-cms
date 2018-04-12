@extends('layouts.default')
@section('content')
<?php
$user = User::where('username', '=', $username)->first();
?>
<div class="profile">
    
    <div class="profile-cover-img" style="background-image: url('<?php echo asset($user->getPhoto($user->cover_photo)->large.'')?>');">
    <div class="profile-name">
    @include('profile.profile-name')
    </div> 
    </div> 
    <div class="profile-inner">
        <div class="profile-update" style="width: 30%;">
            @include('profile.sidebar')
        </div>
        <div class="profile-update" style="padding-top: 10px;">
            <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 18px;"><span class="glyphicon glyphicon-user"></span>&nbsp; Update Profile</h2></header>
            </div>
            <p></p>
            @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>        
                @endforeach
            </div>
            @endif
            <div class="profile-form">
            {{ Form::model($user, array('action' => 'ProfileController@updateProfile', 'id' => 'updateProfileForm', 'files' => true)) }}
              <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            {{ Form::text('name', null, ['class' => 'form-control']) }}
          </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Email Address</label>
            {{ Form::text('email', null, ['class' => 'form-control']) }}
          </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Website</label>
            {{ Form::text('website', null, ['class' => 'form-control']) }}
          </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Upload Profile Photo</label>
            <input id="profile-photo" name="profile-photo" type="file" multiple=false class="file" data-show-upload="false" data-overwrite-initial="false">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Upload Cover Photo</label>
                <p>Sizes at or above 1200x800 will display the best</p>
            <input id="cover-photo" name="cover-photo" type="file" multiple=false class="file" data-show-upload="false" data-overwrite-initial="false">
            </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Save Changes</button>
            {{ Form::close() }}
            </div>
        </div>
        </div>
</div>
<link href="<?php echo asset('css/plugins/bootstrap-fileinput/fileinput.min.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/bootstrap-fileinput/fileinput.min.js')?>"></script>
@stop
