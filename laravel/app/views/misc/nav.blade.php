  <div class="nav-bar">
        <div class="nav-items">
            <a href="{{ URL::to('/') }}"><div class="nav-item">Home</div></a>
            <a href="{{ URL::route('forum') }}"><div class="nav-item">Forum</div></a>
            <a href="{{ URL::route('articles') }}"><div class="nav-item">Articles</div></a>
            <a href="{{ URL::route('classifieds') }}"><div class="nav-item">Classifieds</div></a>
            <a href="{{ URL::route('galleries') }}"><div class="nav-item">Galleries</div></a>
            @if(Auth::user())
            <a href="{{ URL::route('profile', Auth::user()->username) }}"><div class="nav-item">My Profile</div> </a>
            @else
            <a href="{{ URL::route('login') }}"><div class="nav-item">My Profile</div></a>
            @endif
            {{ Form::open(['action' => 'MiscController@siteSearch']) }}
            <span class="right-inner-search">
                   <i class="glyphicon glyphicon-search"></i>
                <input type="search" class="search-box" style="text-indent: 20px;" placeholder="Search"/>                    
            </span>
            {{ Form::close() }}
        </div>         
    </div>  