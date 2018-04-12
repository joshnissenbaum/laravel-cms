@extends('layouts.default')
@section('content')
<div class="articles">

    <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
    <div class="main-header">
        <a href="{{ URL::previous() }}"><h1><a href="{{ URL::route('articles') }}"><span class="glyphicon glyphicon-th-list"></span>&nbsp; Articles</a> &middot;&nbsp;</h1>
    </div>
    </div>
    <div class="grey-bg-hdr" style="padding: 0; background: none;">
    <div class="main-header">
        <h1>&nbsp;{{ $category->name }}</h1>
    </div>
    </div>
    <div class="dropdown" style="float: right;">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: grey; border-color: transparent;">
        <span class="caret" aria-hidden="true"></span>
        &nbsp;{{ $category->name }}
        </button>
        <ul class="dropdown-menu">
        @foreach(ArticleCategory::where('id', '!=', $category->id)->get() as $cat)
            <li><a href="{{ URL::route('article.category', array('id' => $cat->id)) }}">{{ $cat->name }}</a></li>
        @endforeach
        </ul>
    </div>
    <hr style="margin-bottom: 5px;">   
    <?php $articles = Article::MostViewedArticles()->where('category_id', '=', $category->id)->where('status', '=', '4')->get(); ?>
    @if($articles->count() == 0)
    <p></p><div class="alert alert-info">There have been no articles posted in this category yet.</div>
    @endif
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
</div>
@stop
        

        
        

  
    
    
    
