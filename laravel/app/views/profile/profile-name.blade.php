@if($user->privacy->show_name == 1)
{{ $user->name }}
@else
{{ $user->username }}
@endif
<hr>
<div id="profile-buttons">
    @include('profile.nav')
</div>