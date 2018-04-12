<div class="submit-article">
       @if ($errors->has())
       <p></p>
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
    <div class="add-article">
       <div class="panel panel-primary">
          <div class="panel-body">
        {{ Form::open(array('class'=>'', 'action'=>'ProfileController@submitArticle', 'files'=>true)) }}
        <span class="addarticle-header">{{ Form::label('title', 'Title:') }}</span>
        <span class="addarticle-input">
        <input type="text" class="form-control" name="title" value="{{Input::old('title')}}"></span>
        <p></p>
        <span class="addarticle-header">{{ Form::label('description', 'Description:') }}</span>
        <span class="addarticle-info">Add a short description which sums up the content of your article. No more than 100 characters.</span>
        <span class="addarticle-input">
        <textarea class="form-control" name="description" style="height: 70px;">{{Input::old('description') }}</textarea></span>
        <p></p>
        <div class="form-group">
        <label for="exampleInputEmail1">Category</label>
        <select name="category" class="form-control">
            @foreach(ArticleCategory::where('admin_restricted', '=', 0)->get() as $cat)
            <option value="{{$cat->id}}">{{ $cat->name }}</option>
            @endforeach
            </select>
        </div>
        <span class="addarticle-header">{{ Form::label('article-uploader', 'Cover Photo:') }}</span>
        <span class="addarticle-info">This will be the main and first photo your viewers will see.</span>
        <div class="form-group" style="padding-top: 5px; width: 100%;">
            <input id="photo-uploader" name="article-uploader" type="file" multiple=false class="file" data-show-upload="false" data-overwrite-initial="false">
        </div>
        <span class="addarticle-header">{{ Form::label('body', 'Body:') }}</span>
        <span class="addarticle-info">The body of your article is the most important part.</span><p></p>
        <textarea name="summernote-1" id="summernote">
        {{ Input::old('summernote-1') }}
        </textarea>
        <p></p><div class="alert alert-info" role="alert">If you want to place images in your article, upload to <a href="http://pasteboard.co/" target="_blank">Pasteboard.co</a> (easiest), <a href="http://postimage.org/" target="_blank">Postimage.org</a> (more options) or <a href="http://tinypic.com" target="_blank">Tinypic.com</a></div>
        <p></p>
        <span><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Post Article</button></span>
        {{ Form::close() }}
           </div>
        </div>
    </div>
</div>
<link href="<?php echo asset('css/plugins/bootstrap-fileinput/fileinput.min.css')?>" rel="stylesheet">
<link href="<?php echo asset('css/plugins/wysibb/default/wbbtheme.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/bootstrap-fileinput/fileinput.min.js')?>"></script>
<script src="<?php echo asset('js/plugins/wysibb/jquery.wysibb.min.js')?>"></script>
<script src="<?php echo asset('js/misc/summernote-init.js')?>"></script>