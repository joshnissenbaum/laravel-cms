    <ul class="nav nav-pills  nav-stacked">
     <li role="presentation" class="{{ set_active(['profile/*/update']) }}"><a href="{{ URL::route('profile.update', array('username' => $user->username)) }}">
     <span class="glyphicon glyphicon-user"></span>&nbsp; Account Info</a></li>
      <li role="presentation" class="{{ set_active(['profile/*/privacy-settings']) }}"><a href="{{ URL::route('profile.privacy', array('username' => $user->username)) }}">
      <span class="glyphicon glyphicon-lock"></span>&nbsp; Privacy Settings</a></li>
    </ul>