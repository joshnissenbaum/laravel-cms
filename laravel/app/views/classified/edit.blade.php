@extends('layouts.default')
@section('content')
   <div class="create-thread">
    <div class="row">
        <div class="col-md-9">
            {{ Form::model($classified, array('action' => 'ClassifiedsController@updateListing', 'files' => 'true')) }}
            <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <h1><a href="{{ URL::route('listing', array('$id' => $classified->id)) }}">{{ $classified->name }} &middot;</a></h1>
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
            {{ Form::hidden('classified', $classified->id) }}
            <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">Name</label>
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                {{ Form::text('price', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Location</label>
                <select id="location" name="location" class="form-control" data-placeholder="Select Location">
                  <?php $location = Location::find($classified->location); ?>
                   <option value="{{ $location->id}}" selected>{{ $location->suburb }} {{ $location->state }} {{ $location->postcode }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select name="category" class="form-control">
                <?php $selcat = ClassifiedCategory::find($classified->category_id); ?>
                <option value="{{$selcat->id}}">{{ $selcat->name }}</option>
                @foreach(ClassifiedCategory::where('id', '!=', $selcat->id)->get() as $cat)
                    <option value="{{$cat->id}}">{{ $cat->name }}</option>
                @endforeach
                </select>
            </div>
             <div class="form-group">
                <label for="exampleInputEmail1">Contact Name</label>
                {{ Form::text('poster_name', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email Address</label>
                {{ Form::text('email', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <div class="checkbox">
                <label>
                    <input name="email_public" type="checkbox" value="yes" @if($classified->email_public) checked @endif> Make Email Public (Everyone can see your email)
                </label>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                {{ Form::text('phone_number', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input name="number_public" type="checkbox" value="yes" @if($classified->number_public) checked @endif> Make Number Public (Everyone can see your number)
                    </label>
                </div>
            </div>
            <hr style="margin-top: 5px; margin-bottom: 5px;">
            <div class="form-group">
                <label for="exampleInputEmail1">Short Description/Tagline</label>
                {{ Form::text('brief_desc', null, ['class' => 'form-control']) }}
            </div>
             <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea id="summernote" style="height: 12em;" name="description" class="form-control">{{ $classified->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Condition</label>
                    <select name="condition" class="form-control">
                    <option>{{ $classified->item_condition }}</option>
                    <option>Brand New</option>
                    <option>New / Never Used</option>
                    <option>Second Hand</option>
                    <option>Damaged / Faulty</option>
                    </select>
            </div>        
            <label for="exampleInputEmail1">Photos in this listing</label>
            @if(ClassifiedPhoto::where('classified_id', '=', $classified->id)->count() == 0)
            <p></p><div class="alert alert-warning">You have not added any photos to this listing yet.</div>
            @endif
            <div class="row">
            @foreach(ClassifiedPhoto::where('classified_id', '=', $classified->id)->get() as $photo)
              <div class="col-md-4" style="margin-bottom: 20px;">
                <div class="profile-gallery-item">
                    <div class="profile-gallery-img" style="background-image: url('{{ asset($photo->getPhoto($photo->photo_id)->mid) }}')">
                    <a href="{{ URL::route('listing.deletephoto', array('id' => $photo->id))}}">
                    <button type="button" class="btn btn-danger" style="float: right;"><span class="glyphicon glyphicon-trash"></span></button>
                    </a>
                    </div>
                </div>    
                </div>
                @endforeach
            </div>
            <p></p><hr><p></p>
            <div class="form-group">
                <label for="exampleInputEmail1">Add photos to this listing</label>
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
<link href="<?php echo asset('css/plugins/select2/select2.css')?>" rel="stylesheet">
<link href="<?php echo asset('css/plugins/bootstrap-fileinput/fileinput.min.css')?>" rel="stylesheet">
<link href="<?php echo asset('css/plugins/wysibb/default/wbbtheme.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/wysibb/jquery.wysibb.min.js')?>"></script>
<script src="<?php echo asset('js/misc/summernote-init.js')?>"></script>
<script src="<?php echo asset('js/plugins/select2/select2.js')?>"></script>
<script src="<?php echo asset('js/misc/location-init.js')?>"></script>
<script src="<?php echo asset('js/plugins/bootstrap-fileinput/fileinput.min.js')?>"></script>
<script src="<?php echo asset('js/misc/uploader-init.js')?>"></script>
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Listing</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete '{{$classified->name}}'?</p>
      </div>
      <div class="modal-footer">
         <a href="{{ URL::route('listing.delete', array('id' => $classified->id)) }}"><button type="button" class="btn btn-primary">Delete</button></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop