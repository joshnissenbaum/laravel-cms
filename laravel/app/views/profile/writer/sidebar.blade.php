<ul class="nav nav-pills nav-stacked">
        <li id="submission-center" <?php if($nav=='profile.writer.home' ) { echo 'class="active"'; } ?> role="presentation"><a href="{{ URL::route('profile.writer.home', array('username' => $user->username)) }}"><span class="glyphicon glyphicon-inbox"></span>&nbsp; Submission Center</a></li>
        <li id="new-submission" <?php if($nav=='profile.writer.new' ) { echo 'class="active"'; } ?> role="presentation">
            <a href="{{ URL::route('profile.writer.new', array('username' => $user->username)) }}">
                <span class="glyphicon glyphicon-bullhorn"></span>&nbsp; Post an Article</a>
        </li>
        <li id="faq-support" <?php if($nav=='profile.writer.faq' ) { echo 'class="active"'; } ?> role="faq-support"><a href="{{ URL::route('profile.writer.faq', array('username' => $user->username)) }}"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; FAQ & Support</a></li>
</ul>
    