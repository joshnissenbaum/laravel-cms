    @extends('layouts.default')
    @section('content')
        <div class="forum-post">
            
        <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <a href="{{ URL::route('forum') }}"><h1>Forum &middot;&nbsp;</a></h1>
        </div>
        </div>
         <div class="grey-bg-hdr" style="padding: 0; background: none;">
        <div class="main-header">
            <h1>&nbsp;{{ $thread->title }}</h1>
        </div>
        </div>
        <hr>
    <span class="forum-post-category">
   <a href="{{ URL::route('forumcategory', array('id' => $thread->category->id )) }}">
   <table style="margin-top: 10px; margin-bottom: 20px;">
   <tr>
    <th><img width="20px" height="auto" src= "<?php echo asset('images/cat.svg')?>"></th>
      <th style="font-size: 16px; padding-left: 5px;">{{ $thread->category->name }}</th>
  </tr>
</table>
    </a>
    </span>
               
                <div class="forum-post-wrapper">

                    <table class="forum-post-table table">
                        <tr>
                            <th valign="top" rowspan="2">
                    <a href="{{ URL::route('profile', array('username' => $thread->author->username)) }}">
                    <div class="forum-post-img" style=" background-image: url('<?php echo asset($thread->author->getPhoto($thread->author->profile_photo)->thumb)?>');"></div></a></th>
                            <th class="forum-post-info">
                                <a href="{{ URL::route('profile', array('username' => $thread->author->username)) }}">
                                    <div class="forum-post-name">{{ $thread->author->username }}</div>
                                </a>&middot;
                                <div class="forum-post-rank">{{ ForumRank::where('id', '=', $thread->author->forum_rank)->first()->rank_name }}</div>
                                <div class="forum-post-badges">
                                    @foreach (UserBadge::where('user_id', '=', $thread->author->id)->get() as $badge)
                                    <span class="label" data-toggle="tooltip" data-placement="bottom" title="{{$badge->badge->description}}" style="background-color: {{$badge->badge->colour}}">
                                    {{ $badge->badge->name }}</span>
                                    @endforeach
                                </div>
                                <div class="forum-post-date">Posted: {{ $thread->created_at->format('j/m/Y') }}</div>
                                <hr class="l">
                            </th>
                        </tr>
                        <tr>
                            <td valign="top" class="forum-post-desc">
                               {{ BBCode::parse($mainpost->body) }}
                               <hr style="margin-top: 10px; margin-bottom: 10px;">
                                <div class="forum-post-body-img"><img src="<?php echo asset($thread->getPhoto($thread->photo)->mid)?>"></div>
                            </td>
                            @if(Auth::check())
                            <div class="forum-post-reply">
                            <a href="{{ URL::route('forumpost.quotereply', array('id' => $thread->id, 'stripped_title' => $thread->stripped_title, 'post' => $mainpost->id))}}"><button type="button" style="margin: 10px 10px 0px 0px" class="btn btn-primary"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>&nbsp; Reply to Thread</button></a>
                            @if($thread->author->id == Auth::user()->id)
                            <a href="{{ URL::route('forum.editthread', array('id' => $thread->id)) }}">
                                <button class="btn btn-default" style="margin: 10px 10px 0px 0px" type="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp; Edit Thread</button>
                            </a>
                            @endif
                            </div>
                            @endif   
                        </tr>
                    </table>

                </div>
                <div class="forum-post-stats-wrapper">
                    <table class="forum-post-stats">
                        <tr>
                            <th style="width: 12%; padding-right: 15px;">Last Updated</th>
                            <th style="width: 50%;">Last Reply</th>
                            <th style="width: 10%;" class="value">{{ ForumPost::where('thread_id', '=', $thread->id)->count()-1 }}</th>
                            <th style="width: 10%;" class="value">{{ ForumThreadView::where('thread_id', '=', $thread->id)->count() }}</th>
                            <th style="width: 10%;" class="value">0</th>
                            <th style="width: 10%;" class="value">0</th>
                        </tr>
                        <tr>
                            <td>{{ $thread->updated_at->format('F j') }}</td>
                            <td>{{ ForumPost::where('thread_id', '=', $thread->id)->orderBy('created_at', 'DESC')->first()->created_at->format('F j') }}</td>
                            <td>replies</td>
                            <td>views</td>
                            <td>users</td>
                            <td>likes</td>
                        </tr>
                    </table>
                </div>
                @foreach($posts as $post)
                <a name="{{$post->id}}">
                    <div class="forum-post-rep-wrapper">

                        <table class="forum-post-table">
                            <tr>
                                <th valign="top" rowspan="2">
                                    <a href="{{ URL::route('profile', array('username' => $post->author->username)) }}">
                            <div class="forum-post-img" style=" background-image: url('<?php echo asset($post->author->getPhoto($post->author->profile_photo)->thumb)?>');"></div></a></th>
                                <th class="forum-post-info">
                                    <a href="{{ URL::route('profile', array('username' => $post->author->username)) }}">
                                        <div class="forum-post-name">{{$post->author->username}} &middot;</div>
                                    </a>
                                    <div class="forum-post-rank">{{ ForumRank::where('id', '=', $post->author->forum_rank)->first()->rank_name }}</div>
                                    <div class="forum-post-badges">
                                        @foreach (UserBadge::where('user_id', '=', $post->author->id)->get() as $badge)
                                        <span class="label" data-toggle="tooltip" data-placement="bottom" title="{{$badge->badge->description}}"  style="background-color: {{$badge->badge->colour}}">{{ $badge->badge->name }}</span> @endforeach
                                    </div>
                                    <div data-toggle="tooltip" data-placement="bottom" title="{{$post->created_at->format('j/m/Y @ h:ia')}}"  class="forum-post-date">Posted: {{$post->created_at->diffForHumans()}}</div>
                                    <hr class="l">
                                </th>
                            </tr>
                            <tr>
                                <td valign="top" class="forum-post-desc">
                                 {{ BBCode::parse($post->body) }}
                                </td>
                            </tr>
                            @if(Auth::check())
                            <span class="forum-post-reply">
                            <a  href="{{ URL::route('forumpost.quotereply', array('id' => $thread->id, 'stripped_title' => $thread->stripped_title, 'post' => $post->id))}}">
                            <button type="button" style="margin: 10px 10px 0px 0px" class="btn btn-primary"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>&nbsp; Reply</button></a>
                             @if($post->author->id == Auth::user()->id)
                             <a href="{{ URL::route('forum.editpost', array('id' => $post->id)) }}">
                                <button class="btn btn-default" style="margin: 10px 10px 0px 0px" type="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                            </a>
                            @endif
                            </span>
                            @endif
                        </table>
                    </div>
                </a><p></p><hr><p></p>
                @endforeach
                @if(Auth::check())
                <a name="reply">
                    <div class="reply-thread">
                        @if ($errors->has())
                       <p></p>
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>        
                            @endforeach
                        </div>
                        @endif
                        {{ Form::open(array('action' => 'ForumController@replyToThread', 'id' => 'replythread')) }}
                        <div class="form-group">
                            <textarea class="form-control" id="summernote" name="body" placeholder="Reply to thread...">{{ Input::old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Post Reply</button>
                        </div>
                        <input type="text" style="display: none;" value="{{ $thread->id }}" name="threadid">
                    </div>
                    {{ Form::close() }}
                </a>
                @endif
            </div>

            <?php
            if(ForumThreadView::where('ip_address', '=', getIPAddress())->count() < 1) { 
                $view = new ForumThreadView;
                $view->thread_id = $thread->id;
                if(Auth::check()) { $view->user_id = Auth::user()->id; }
                $view->ip_address = getIPAddress();
                $view->save();
            }
            ?>
                @stop