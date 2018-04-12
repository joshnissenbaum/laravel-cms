
<div class="column-articles">   
        <div class="column-widget">
                <header class="header"><h2><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>&nbsp;Popular Articles</h2></header>
            </div>
             @foreach (Article::where('status', '=', '4')->MostViewedArticles()->take(20) as $article)
        <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}">
        <div class="column-article">
        
        <table class="column-articles-tbl">
          <tr>
            
            <th style="width:90%;">
                  <div class="carticle-title">{{ $article->title }}</div>
              </th>
              <th style="padding-left: 10px;"><div class="carticle-img" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->thumb)?>');"></div></th>
          </tr>
        </table>
    </div>
    </a>
          <hr>
        @endforeach
</div>