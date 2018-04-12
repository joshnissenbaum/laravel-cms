@extends('layouts.default')
@section('content')
    <div class="forum-category">
        <div class="top-bar">
            <div class="top-bar-cell" style="width: 5%;">

                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: grey; border-color: transparent;">
                       <span class="caret" aria-hidden="true"></span>&nbsp; 
                        {{$category->name}}
                        </button>
                    <ul class="dropdown-menu">
                        @foreach(ForumCategory::where('id', '!=', $category->id)->get() as $cat)
                        <li><a href="{{ URL::route('forumcategory', array('id' => $cat->id)) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="top-bar-cell" style="width: 5%; padding-left: 10px;">

                <a href="{{ URL::route('forum') }}">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp; Forum</button>
                </a>

            </div>
            <div class="top-bar-cell" style="width: 100%;">
                @if(Auth::check())
                <div class="forum-reply">
                    <a href="{{URL::route('forum.createthread', array('id' => $category->id))}}">
                       <button type="button" class="btn btn-primary btn-md">
                           <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Create Thread
                    </button>
                    </a>
                </div> @endif
            </div>
        </div>





        <table class="forum-cat-table">
            <tr class="top">
                <th style="width: 60%;" style=""><span style="margin-left: 10px;">Topic</span></th>
                <th>Posted By</th>
                <th>Replies</th>
                <th>Views</th>
                <th>Activity</th>
            </tr>
            @foreach(ForumThread::where('category_id', '=', $category->id)->orderBy('sticky', 'DESC')->orderBy('created_at', 'DESC')->get() as $thread)
            <tr>
                <td class="topic-title">
                <a href="{{ URL::route('forumpost', array('$id' => $thread->id, 'stripped_title' => $thread->stripped_title)) }}">
                <img src="<?php echo asset($thread->getPhoto($thread->photo)->thumb)?>" width="30px" height="30px">
                @if($thread->sticky == 1) <strong><span class="glyphicon glyphicon-pushpin"></span>&nbsp; @endif
                {{$thread->title}}</a></td>
                @if($thread->sticky == 1) </td></strong> @endif
                <td valign="middle">
                    <a href="{{ URL::route('profile', array('username' => $thread->author->username)) }}">
        <img width="30px" height="auto" src= "<?php echo asset($thread->getPhoto($thread->author->profile_photo)->thumb)?>"><span class="author">{{$thread->author->username}}</span>
          </a>
                </td>
                <td>{{ ForumPost::where('thread_id', '=', $thread->id)->count()-1 }}</td>
                <td>{{ ForumThreadView::where('thread_id', '=', $thread->id)->count() }}</td>
                <td>{{ ForumPost::where('thread_id', '=', $thread->id)->orderBy('created_at', 'DESC')->first()->created_at->format('F j') }}</td>
            </tr>
            @endforeach



        </table>
        @if(Auth::check())
        <div class="forum-reply">
            <a href="{{URL::route('forum.createthread', array('id' => $category->id))}}">
                <button id="create-thread" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Create Thread</button>
            </a>
        </div>
        @endif
    </div>
    @stop