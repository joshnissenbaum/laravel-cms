@extends('layouts.default')
@section('content')
   <div class="create-thread">
    <div class="row">
        <div class="col-md-9">
            {{ Form::model($article, array('action' => 'ArticleController@updateArticle', 'files' => 'true')) }}
            <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <h1><a href="{{ URL::route('article', array('$id' => $article->id, 'stripped_title' => $article->stripped_title)) }}">{{ $article->title }} &middot;</a></h1>
        </div>
        </div>
         <div class="grey-bg-hdr" style="padding: 0; background: none;">
         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" style="display: inline-block; position: absolute; right: 0; margin-right: 15px;"><span class="glyphicon glyphicon-trash"></span>&nbsp; Delete</button>
        <div class="main-header">
            <h1>&nbsp; Edit</h1>
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
            {{ Form::hidden('article', $article->id) }}
            <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">Title</label>
                {{ Form::text('title', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select name="category" class="form-control">
                <?php $selcat = ArticleCategory::find($article->category_id); ?>
                <option value="{{$selcat->id}}">{{ $selcat->name }}</option>
                @foreach(ArticleCategory::where('id', '!=', $selcat->id)->get() as $cat)
                    <option value="{{$cat->id}}">{{ $cat->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Photo</label>
                <input id="photo-uploader" name="uploader" type="file" multiple=false class="file" data-show-upload="false" data-overwrite-initial="false">
                <p></p><img width="auto" height="200px" src="<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>"><br>
                <br><div class="alert alert-info" role="alert">If you would like to change your thread photo then upload a new one - otherwise skip this part.</div>
            </div>
            <div class="form-group" style="margin-top: -10px;">
                <label for="exampleInputEmail1"></label>
                <textarea id="summernote" name="body" class="form-control" placeholder="What do you want to say?">
                    <?php $mainpost = ArticleBody::where('article_id', '=', $article->id)->first(); ?>
                {{ $mainpost->text }}
                </textarea>
            </div><p></p>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Save Changes</button>
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
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Article</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete '{{$article->title}}'?</p>
      </div>
      <div class="modal-footer">
         <a href="{{ URL::route('article.delete', array('id' => $article->id)) }}"><button type="button" class="btn btn-primary">Delete</button></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop