@extends('layouts.default')
@section('content')
   <div class="create-thread">
    <div class="row">
        <div class="col-md-9">
            {{ Form::open(array('action' => 'ForumController@quoteReply', 'files' => 'true')) }}
            <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <h1><a href="{{ URL::route('forumpost', array('$id' => $thread->id, 'stripped_title' => $thread->stripped_title)) }}">{{ $thread->title }} &middot;</a></h1>
        </div>
        </div>
         <div class="grey-bg-hdr" style="padding: 0; background: none;">
        <div class="main-header">
            <h1>&nbsp; Reply</h1>
        </div>
       </div>
        <hr>   
          @if ($errors->has())
           <p></p>
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>        
                @endforeach
            </div>
            @endif
            {{ Form::hidden('thread', $thread->id) }}
            <div class="form-group" style="margin-top: -10px;">
                <label for="exampleInputEmail1"></label>
                <textarea id="summernote" name="body" class="form-control" placeholder="What do you want to say?">
                    [quote] Originally posted by [b]{{ $post->author->username }}[/b]
                    {{ $post->body }}[/quote]                  
                </textarea>
            </div><p></p>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Post Reply</button>
            {{ Form::close() }}
        </div>


        <div class="col-md-3">
            @include('misc.general-right-column')
        </div>
    </div>
</div>
<link href="<?php echo asset('css/plugins/wysibb/default/wbbtheme.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/wysibb/jquery.wysibb.min.js')?>"></script>
<script src="<?php echo asset('js/misc/summernote-init.js')?>"></script>
@stop