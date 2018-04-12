<div class="top-articles" style="margin-top: 10px;">
    <a href="{{ URL::route('articles') }}">
   <div class="column-widget">
    <header class="header">
    <h2><img width="20" height="auto" src="<?php echo asset('images/news.svg')?>">&nbsp; Articles & News</h2></header>
    </div>  
    </a>
@foreach (Article::TrendingArticles()->where('status', '=', '4')->get()->take(6) as $article)
        <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
        <div class="article animated fadeInUp">
      <div class="article-img">
                <div class="article-img-inner" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>');">
                </div>
                </div>
        <div class="article-info">
        <div class="article-title">{{{ @strip_tags(Str::limit($article->title, 50)) }}}</div>
        {{{ @strip_tags(Str::limit($article->description, 150)) }}}
        <div class="article-author">Posted by {{ $article->author->username }} on  {{ $article->created_at->format('d/m/Y') }}</div>
        </div>
        </div>
    </a>
    @endforeach
</div> 