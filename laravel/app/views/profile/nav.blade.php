<a href="{{ URL::route('profile', array('username' => $user->username)) }}">
    <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="Home"><img width="20" height="auto" src="<?php echo asset('images/home.svg')?>"></button>
</a>
<?php if(Auth::check() && Auth::user()->id != $user->id && $user->privacy->messages == 1) { ?>
    <a href="{{ URL::route('messages.create', ['username' => Auth::user()->username, 'to' => $user->username])}}">
    <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="Send a Message"><img width="20" height="auto" src="<?php echo asset('images/msg.svg')?>"></button>
</a>
        <?php } ?>
        
        <a href="{{ URL::route('profile.articles', array('username' => $user->username)) }}">
            <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="View Articles"><img width="20" height="auto" src="<?php echo asset('images/articles.svg')?>"></button>
        </a>
        <a href="{{ URL::route('profile.galleries', array('username' => $user->username)) }}">
            <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="My Galleries"><img width="20" height="auto" src="<?php echo asset('images/photo-camera.svg')?>"></button>
        </a>
        <?php if(Auth::check() && Auth::user()->id == $user->id)
        {?>
            <div id="profile-buttons-right">
                <a href="{{ URL::route('profile.writer.newad', array('username' => $user->username)) }}">
                    <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="Sell Something"><img width="20" height="auto" src="<?php echo asset('images/dollar.svg')?>"></button>
                </a>
                <a href="{{ URL::route('profile.writer.home', array('username' => $user->username)) }}">
                    <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="Writer's Center"><img width="20" height="auto" src="<?php echo asset('images/writing.svg')?>"><span style="vertical-align: top; margin-top: 4px; margin-left: 5px;" class="badge">{{ Article::where('admin_comments', '!=', 'null')->count() }}</span></button>
                </a>
                <a href="{{ URL::route('profile.update', array('username' => $user->username)) }}">
                    <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="Update Profile"><img width="20" height="auto" src="<?php echo asset('images/update-prof.svg')?>"></button>
                </a>
                <a href="{{ URL::route('messages', array('username' => $user->username)) }}">
                    <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="Messages"><img width="20" height="auto" src="<?php echo asset('images/msg.svg')?>"><span style="vertical-align: top; margin-top: 4px; margin-left: 5px;" class="badge">{{ Conversation::with('participant')->userNewMessages(Auth::user()->id)->count() }}</span></button>
                </a>
                <a href="{{ URL::route('logout') }}">
                    <button type="button" class="button" data-toggle="tooltip" data-placement="bottom" title="Logout"><img width="18" height="auto" src="<?php echo asset('images/logout.svg')?>"></button>
                </a>
            </div>
            <?php } ?>