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
    <div class="profile-data" style="padding-left: 0; padding-right: 0;">
        <span class="header">Add Gallery
        </span><p></p>
            @if ($errors->has())
           <p></p>
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>        
                @endforeach
            </div>
            @endif
            {{ Form::open(array('action' => 'ProfileController@addGallery', 'id' => 'addgallery', 'files' => 'true')) }}
            <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{Input::old('title')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Photos</label>
                <input id="photo-uploader" name="uploader[]" type="file" multiple=true class="file" data-show-upload="false" data-overwrite-initial="false">
                <br><div class="alert alert-info" role="alert">Select multiple photos by pressing browse then the <strong>shift</strong> or <strong>control</strong> buttons on your keyboard.</div>
            </div>
            <div class="form-group">
               <label for="exampleInputEmail1">Gallery Options</label>
                <div class="checkbox">
                            <label>
                                <input name="public" type="checkbox" value="yes"> This is a private photo gallery (Only I can view it)
                            </label>
                        </div>
            </div>
            <p></p>
            <button type="submit" class="btn btn-primary">Add Gallery</button>
            {{ Form::close() }}
    </div>
    </div>
</div>
<link href="<?php echo asset('css/plugins/bootstrap-fileinput/fileinput.min.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/bootstrap-fileinput/fileinput.min.js')?>"></script>
<script src="<?php echo asset('js/misc/uploader-init.js')?>"></script>
@stop