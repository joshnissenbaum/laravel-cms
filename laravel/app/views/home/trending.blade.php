   <div class="trending-articles">
      <div class="column-widget">
    <header class="header">
    <h2><img width="20" height="auto" src="<?php echo asset('images/trending.svg')?>">&nbsp; Trending Forum Posts</h2></header>
    </div>  
    <div class="tren-wrapper">
            @foreach (ForumThread::TrendingPosts()->get()->take(8) as $thread)
             <a href="{{ URL::route('forumpost', array('$id' => $thread->id)) }}">
            <div class="tren-item animated fadeInUp">
                <div class="tren-item-img" style="background-image: url('<?php echo asset($thread->getPhoto($thread->photo)->mid)?>');">
                </div>
                <div class="tren-item-text">
                {{ $thread->title }}
                </div>
                  <div class="tren-item-desc">
                  <?php $desc = Str::limit($thread->post()->first()->body, 100); ?>
                  {{ BBCode::stripBBCodeTags($desc) }}
               
                </div>
                <div class="tren-item-author">
                Posted {{ $thread->created_at->format('d F') }} by {{$thread->author->username}}
                 
                </div>
               
            </div>
            </a>
            @endforeach
        </div>
</div>