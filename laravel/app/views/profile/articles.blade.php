@extends('layouts.default')
@section('content')
<?php
$user = User::where('username', '=', $username)->first();
?>
<div class="profile">
    <div class="profile-cover-img" style="background-image: url('<?php echo asset($user->getPhoto($user->cover_photo)->large.'')?>');">
    <div class="profile-name">
    @include('profile.profile-name')
    </div> 
    </div>
    <div class="profile-inner">
    <div class="profile-data" style="padding-left: 0;">
         <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 20px;">Articles</h2></header>
            </div>
            @if(Article::where('author_id', '=', $user->id)->where('status', '=', '4')->count() == 0)
                <div class="alert alert-info" style="margin-top: 0.5em;"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; {{ $user->username }} has not posted any articles yet.</div>
            @else
            @foreach ($articles = Article::where('author_id', '=', $user->id)->where('status', '=', '4')->orderBy('created_at', 'DESC')->paginate(10) as $article)
            <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
           <div class="media">
              <div class="media-left media-middle">
                <img class="media-object" width="100" height="100" src="{{ asset($article->getPhoto($article->cover_photo)->thumb) }}" alt="...">
              </div>
              <div class="media-body">
                <h3 class="media-heading">{{{ $article->title }}}</h3>
                {{{ $article->description }}}<p></p>
                <b>Posted:</b> {{ $article->author->created_at->format('d/m/Y') }}
              </div>
            </div>
            </a><p></p>
            @endforeach
            {{ $articles->links() }}
            @endif
    </div>
    </div>
</div>
@stop