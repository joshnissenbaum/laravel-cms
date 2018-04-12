@extends('layouts.default')
@section('content')
   <div class="main-article" style="margin-top: 15px;">
    <div class="row">
    <div class="col-md-9">
    <div class="main-article-inner">
        <div class="main-article-title">{{ $article->title }}
        @if(Auth::check() && $article->author_id == Auth::user()->id)
        <a href="{{ URL::route('article.edit', array('id' => $article->id))}}"><button class="btn btn-primary" type="button" style="float: right;"><span class="glyphicon glyphicon-pencil"></span></button></a>
        @endif
        </div>
        <hr>
        <div class="main-article-info">
            <div class="main-article-info-name">
                Posted by <strong><a href="{{ URL::route('profile', array('username' => $article->author()->first()->username)) }}">{{ $article->author->username }}</a></strong>
            </div>
            <div class="main-article-info-date">
            {{ $article->created_at->format('j F Y g:ia') }}
            </div>
        </div>
         <div style="margin-bottom: 2px; margin-top: 4px;"></div>
            <div class="main-article-info">
                <div class="main-article-info-name">
                <strong>Posted in:</strong> {{ $article->category->name }}<br>
                <strong>Views:</strong> {{ ArticleView::where('article_id', '=', $article->id)->count(); }}
                </div>
                <div class="main-article-info-date">
                    <div class="fb-share-button" data-href="{{ Route::getCurrentRoute()->getPath() }}" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
                </div>
            </div>
        </div>
        <p></p>
        @if($article->status != 4)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp; This article has not been approved and is not visible to the public. Only you can see the content on this page.</div>
        @endif
        <img class="img-responsive" src="<?php echo asset($article->getPhoto($article->cover_photo)->large.'')?>">
        <div class="main-article-body">
        {{ BBCode::parse($article->body->text) }}
        </div>
        <p></p>
    </div>
     <div class="col-md-3">
        @include('misc.general-right-column')
    </div>
    </div>
    </div>
<?php
if(ArticleView::where('ip_address', '=', getIPAddress())->count() < 1) { 
    $view = new ArticleView;
    $view->article_id = $article->id;
    if(Auth::check()) { $view->user_id = Auth::user()->id; }
    $view->ip_address = getIPAddress();
    $view->save();
}
?>
@stop