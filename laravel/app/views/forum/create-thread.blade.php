@extends('layouts.default')
@section('content')
   <div class="create-thread">
    <div class="row">
        <div class="col-md-9">
            {{ Form::open(array('action' => 'ForumController@createThread', 'id' => 'createthread', 'files' => 'true')) }}
            <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <a href="{{ URL::previous() }}"><h1><a href="{{ URL::route('forumcategory', array('id' => Input::get('id'))) }}">{{ ForumCategory::find(Input::get('id'))->name }}</a> &middot;&nbsp;</a></h1>
        </div>
        </div>
         <div class="grey-bg-hdr" style="padding: 0; background: none;">
        <div class="main-header">
            <h1>&nbsp;Create Thread</h1>
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
            <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{Input::old('title')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select name="category" class="form-control">
                <?php if(Input::get('id')) {
                    $selcat = ForumCategory::find(Input::get('id'));;
                ?>
                <option value="{{$selcat->id}}">{{ $selcat->name }}</option>
                 <?php    
                    }?>
                    @foreach(ForumCategory::where('id', '!=', $selcat->id)->get() as $cat)
                    <option value="{{$cat->id}}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Photo</label>
                <input id="photo-uploader" name="create-thread-uploader" type="file" multiple=false class="file" data-show-upload="false" data-overwrite-initial="false">
                <br><div class="alert alert-info" role="alert">If you would like to see your post on the homepage, be sure to add a photo!</div>
            </div>
            <div class="form-group" style="margin-top: -10px;">
                <label for="exampleInputEmail1"></label>
                <textarea id="summernote" name="body" class="form-control" placeholder="What do you want to say?">
                    {{ Input::old('body') }}
                </textarea>
            </div><p></p>
            <div class="g-recaptcha" data-sitekey="6LdxSygTAAAAABadcUg5YRKfKqiZK6a6VuYNICdp"></div><p></p>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Post Thread</button>
            {{ Form::close() }}
        </div>
        <div class="col-md-3">
            @include('misc.general-right-column')
        </div>
    </div>
</div>
<link href="<?php echo asset('css/plugins/bootstrap-fileinput/fileinput.min.css')?>" rel="stylesheet">
<link href="<?php echo asset('css/plugins/wysibb/default/wbbtheme.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/bootstrap-fileinput/fileinput.min.js')?>"></script>
<script src="<?php echo asset('js/plugins/wysibb/jquery.wysibb.min.js')?>"></script>
<script src="<?php echo asset('js/misc/summernote-init.js')?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop