@extends('layouts.default')
@section('content')
<div class="articles">
   <div class="column-widget">
    <header class="header">
    <h2><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;Most Popular</h2>
    <div class="dropdown" style="float: right;">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: grey; border-color: transparent;">
        <span class="caret" aria-hidden="true"></span>
        &nbsp;Article Categories
        </button>
        <ul class="dropdown-menu">
        @foreach(ArticleCategory::all() as $cat)
            <li><a href="{{ URL::route('article.category', array('id' => $cat->id)) }}">{{ $cat->name }}</a></li>
        @endforeach
        </ul>
    </div>
    </header>
    </div>
    <?php $articles = Article::MostViewedArticles()->where('status', '=', '4')->take(3)->get(); ?>
    @foreach ($articles as $article)
    <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
    <div class="article animated fadeInUp">
        <div class="article-img">
        <div class="article-img-inner" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>');">
        </div>
        </div>
    <div class="article-info">
        <div class="article-title">{{{ @strip_tags(Str::limit($article->title, 50)) }}}</div>
        {{{ @strip_tags(Str::limit($article->description, 100)) }}}
        <div class="article-author">Posted by {{ $article->author->username }} on  {{ $article->created_at->format('d/m/Y') }}</div>
    </div>
    </div>
    </a>
    @endforeach
    <div class="trending-articles">
    <div class="column-widget">
    <header class="header">
    <h2><span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>&nbsp;Trending</h2></header>
    </div>
    @foreach (Article::TrendingArticles()->where('status', '=', '4')->whereNotIn('articles.id', array_pluck($articles, 'id'))->take(6)->get() as $article)
    <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
    <div class="article animated fadeInUp">
        <div class="article-img">
        <div class="article-img-inner" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>');">
        </div>
        </div>
    <div class="article-info">
        <div class="article-title">{{{ @strip_tags(Str::limit($article->title, 50)) }}}</div>
        {{{ @strip_tags(Str::limit($article->description, 100)) }}}
        <div class="article-author">Posted by {{ $article->author->username }} on  {{ $article->created_at->format('d/m/Y') }}</div>
    </div>
    </div>
    </a>
    @endforeach
    </div>  
    
    <div class="categorised-articles">
    @foreach(ArticleCategory::all() as $category)
    <div class="categorised-article">
     <div class="column-widget">
        <header class="header">
            <a href="{{ URL::route('article.category', array('id' => $category->id))}}"><h2>{{$category->name}}</h2></a></header>
     </div>
     <?php $size = $category->size; ?>
     @if($size == 6)
   <?php $articles = Article::MostViewedArticles()->where('status', '=', '4')->where('category_id', '=', $category->id)->take(3)->get(); ?>
    @foreach ($articles as $article)
    <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
    <div class="article">
        <div class="article-img">
        <div class="article-img-inner" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>');">
        </div>
        </div>
    <div class="article-info">
        <div class="article-title">{{{ @strip_tags(Str::limit($article->title, 50)) }}}</div>
        {{{ @strip_tags(Str::limit($article->description, 100)) }}}
        <div class="article-author">Posted by {{ $article->author->username }} on  {{ $article->created_at->format('d/m/Y') }}</div>
    </div>
    </div>
    </a>
   @endforeach
    <?php $articles = Article::TrendingArticles()->where('status', '=', '4')->where('category_id', '=', $category->id)->whereNotIn('articles.id', array_pluck($articles, 'id'))->take(3)->get(); ?>
    @foreach ($articles as $article)
    <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
    <div class="article">
        <div class="article-img">
        <div class="article-img-inner" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>');">
        </div>
        </div>
    <div class="article-info">
        <div class="article-title">{{{ @strip_tags(Str::limit($article->title, 50)) }}}</div>
        {{{ @strip_tags(Str::limit($article->description, 100)) }}}
        <div class="article-author">Posted by {{ $article->author->username }} on  {{ $article->created_at->format('d/m/Y') }}</div>
    </div>
    </div>
    </a>
    @endforeach
     @else
       <?php $articles = Article::TrendingArticles()->where('status', '=', '4')->where('category_id', '=', $category->id)->take($size)->get(); ?>
    @foreach ($articles as $article)
    <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
    <div class="article">
        <div class="article-img">
        <div class="article-img-inner" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>');">
        </div>
        </div>
    <div class="article-info">
        <div class="article-title">{{{ @strip_tags(Str::limit($article->title, 50)) }}}</div>
        {{{ @strip_tags(Str::limit($article->description, 100)) }}}
        <div class="article-author">Posted by {{ $article->author->username }} on  {{ $article->created_at->format('d/m/Y') }}</div>
    </div>
    </div>
    </a>
    @endforeach          
     @endif
    @endforeach
    </div>
    </div>   
</div>
@stop
        

        
        

  
    
    
    
