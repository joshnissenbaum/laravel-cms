@extends('layouts.default')
@section('content')
<div class="forum-wrapper">

<table class="forum">
  <tr class="top-bar">
    <th style="padding-left: 5px;" >Category</th>
    <th>Latest</th>
    <th class="topics">Topics</th>
  </tr>
    @foreach (ForumCategory::all() as $cat)
  <tr class="sect">
    <td class="category" style="border-color: {{ $cat->colour_code }};">
    <span class="title"><a href="{{ URL::route('forumcategory', array('id' => $cat->id)) }}">{{$cat->name}}</a></span><br>
    <span class="desc">{{ $cat->description }}</span></td>
    <td style="padding-top: 10px; padding-bottom: 10px;">
        @foreach ($cat->thread()->orderBy('created_at', 'desc')->take(3)->get() as $thread)
        <a href="{{ URL::route('forumpost', array('$id' => $thread->id, '$stripped_title' => $thread->stripped_title)) }}"><span class="desc-title">{{$thread->title}}</span></a>
        <span class="desc-date">Posted by <a href="{{ URL::route('profile', array('username' => $thread->author->username)) }}">{{$thread->author->username}}</a> | {{ $thread->created_at->format('j/m/Y g:ia') }}</span>
        @endforeach
    </td>
      <td class="topics"><span class="nv-cat-value">{{ $cat->thread->count() }}</span> <span class="nv-cat-time">/ threads</span><br><span class="nv-cat-value">{{ $cat->countPosts($cat->id) }}</span>
      <span class="nv-cat-time">/ posts</span></td>
  </tr>
    @endforeach
</table>
</div>
@stop