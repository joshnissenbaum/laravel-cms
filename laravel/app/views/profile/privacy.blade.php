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
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 18px;"><span class="glyphicon glyphicon-lock"></span>&nbsp; Privacy Settings</h2></header>
            </div>
            <p></p>
            <div class="profile-form">
            <?php $privacy = $user->privacy()->first(); ?>
            {{ Form::open(array('action' => 'ProfileController@completeProfilePrivacy', 'id' => 'completePrivacyForm')) }}
                 <div class="form-group">
              <div class="checkbox">
                <label>
                  <input id="show-name" name="show-name" type="checkbox" value="yes"  <?php if($privacy->show_name == 1) { echo'checked="checked"'; } ?>">Show my name to the public
                </label>
                  </div>
          </div>
              <div class="form-group">
              <div class="checkbox">
                <label>
                     <input id="email-public" name="email-public" type="checkbox" value="yes" <?php if($privacy->email_public == 1) { echo'checked="checked"'; } ?>">
                    Show my email address to the public
                </label>
                </div>
          </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input id="email-friends" name="email-friends" type="checkbox" value="yes"  <?php if($privacy->email_friends == 1) { echo'checked="checked"'; } ?>">Show my email address to my friends
                </label>
                  </div>
          </div>
                   <div class="form-group">
              <div class="checkbox">
                <label>
                  <input id="website-public" name="website-public" type="checkbox" value="yes" <?php if($privacy->website_public == 1) { echo'checked="checked"'; } ?>">Show my website to the public
                </label>
                  </div>
          </div>
                   <div class="form-group">
              <div class="checkbox">
                <label>
                  <input id="website-friends" name="website-friends" type="checkbox" value="yes" <?php if($privacy->website_friends == 1) { echo'checked="checked"'; } ?>">Show my website to my friends
                </label>
                  </div>
          </div>
                   <div class="form-group">
              <div class="checkbox">
                <label>
                  <input id="messages" name="messages" type="checkbox" value="yes" <?php if($privacy->messages == 1) { echo'checked="checked"'; } ?>">Allow private messages
                </label>
                  </div>
          </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Save Changes</button>
            {{ Form::close() }}
            </div>
        </div>
        </div>


</div>
@stop