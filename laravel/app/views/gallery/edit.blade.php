@extends('layouts.default')
@section('content')
   <div class="create-thread">
    <div class="row">
        <div class="col-md-9">
            {{ Form::model($gallery, array('action' => 'GalleryController@updateGallery', 'files' => 'true')) }}
            <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <h1><a href="{{ URL::route('gallery', array('$id' => $gallery->id)) }}">{{ $gallery->name }} &middot;</a></h1>
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
            {{ Form::hidden('gallery', $gallery->id) }}
            <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">Name</label>
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            <label for="exampleInputEmail1">Photos in this gallery</label>
            @if(GalleryPhoto::where('gallery_id', '=', $gallery->id)->count() == 0)
            <p></p><div class="alert alert-warning">You have not added any photos to this gallery yet.</div>
            @endif
            <div class="row">
            @foreach(GalleryPhoto::where('gallery_id', '=', $gallery->id)->get() as $photo)
              <div class="col-md-4" style="margin-bottom: 20px;">
                <div class="profile-gallery-item">
                    <div class="profile-gallery-img" style="background-image: url('{{ asset($photo->getPhoto($photo->photo_id)->mid) }}')">
                    <a href="{{ URL::route('gallery.deletephoto', array('id' => $photo->id))}}">
                    <button type="button" class="btn btn-danger" style="float: right;"><span class="glyphicon glyphicon-trash"></span></button>
                    </a>
                    </div>
                <div class="profile-gallery-info">
                    <input type="text" class="form-control" name="caption[{{ $photo->id }}]" value="{{ $photo->caption }}" placeholder="Write a caption for this photo...">                
                </div>
                </div>    
                </div>
                @endforeach
            </div>
            <p></p><hr><p></p>
            <div class="form-group">
                <label for="exampleInputEmail1">Upload photos to this gallery</label>
                <input id="photo-uploader" name="uploader[]" type="file" multiple=true class="file" data-show-upload="false" data-overwrite-initial="false">
                <br><div class="alert alert-info" role="alert">Select multiple photos by pressing browse then the <strong>shift</strong> or <strong>control</strong> buttons on your keyboard.</div>
            </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Save Changes</button>
            {{ Form::close() }}
        </div>


        <div class="col-md-3">
            @include('misc.general-right-column')
        </div>
    </div>
</div>
<link href="<?php echo asset('css/plugins/bootstrap-fileinput/fileinput.min.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/bootstrap-fileinput/fileinput.min.js')?>"></script>
<script src="<?php echo asset('js/misc/uploader-init.js')?>"></script>
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Gallery</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete '{{$gallery->name}}'?</p><p></p>All the photos in this gallery will be deleted.
      </div>
      <div class="modal-footer">
         <a href="{{ URL::route('gallery.delete', array('id' => $gallery->id)) }}"><button type="button" class="btn btn-primary">Delete</button></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop