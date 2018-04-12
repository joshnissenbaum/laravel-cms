      <div class="column-widget">
                <header class="header">
                    <h2>Sponsored</h2></header>
                <span class="content">
            <div class="column-widget-img" style="background-image: url('<?php echo asset('images/castrol.jpg')?>');"></div>
            </span>
            </div>
            <div class="column-widget">
                <header class="header">
                    <h2>Articles</h2></header>
                <div class="content">
                   @foreach(Article::TrendingArticles()->where('status', '=', '4')->get()->take(6) as $article)
                    <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
                    <div class="media">
                      <div class="media-left">
                          <img class="media-object" width="64" height="64" src="<?php echo asset($article->getPhoto($article->cover_photo)->thumb)?>" alt="...">
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">{{$article->title}}</h4>
                        {{Str::limit($article->description, 100)}}
                      </div>
                    </div>
                    </a><p></p>
                    @endforeach
                </div>
            </div>
            <div class="column-widget">
                <header class="header">
                    <h2>Forum Posts</h2></header>
                <div class="content">
               @foreach(ForumThread::TrendingPosts()->get()->take(3) as $thread)
                   <a href="{{ URL::route('forumpost', array('$id' => $thread->id)) }}">
                    <div class="media">
                      <div class="media-left">
                          <img class="media-object" width="64" height="64" src="<?php echo asset($thread->getPhoto($thread->photo)->thumb)?>" alt="...">
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">{{$thread->title}}</h4>
                        {{ BBCode::stripBBCodeTags(Str::limit($thread->post()->first()->body, 100)) }}
                      </div>
                    </div>
                    </a><p></p>
              @endforeach
            </div>
            </div>