@extends('layouts.default')
  @section('content')
  <div class="profile">
    <div class="profile-cover-img" style="background-image: url('<?php echo asset($user->getPhoto($user->cover_photo)->large.'')?>');">
    <div class="profile-name">
       @include('profile.profile-name')
    </div> 
    </div>
</div>
   <div class="create-thread" style="margin-top: 10px;">
    <div class="row">
        <div class="col-md-12">
            <h1>Want to sell something?</h1><hr>
            @if ($errors->has())
            <p></p>
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error) {{ $error }}
                <br> @endforeach
            </div>
            @endif
            {{ Form::open(array('action' => 'ClassifiedsController@createAd', 'id' => 'createad', 'files' => 'true')) }}
            <p></p>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Step 1/4 - Basic Info</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" name="name" value="{{ Input::old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">$</span>
                            <input type="text" name="price" class="form-control" aria-describedby="basic-addon1" value="{{ Input::old('price') }}">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="exampleInputEmail1">Location</label>
                        <select id="location" name="location" class="form-control" data-placeholder="Select Location">
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Step 2/4 - Contact Info</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contact Name:</label>
                        <input type="text" name="poster_name" class="form-control" aria-describedby="basic-addon1" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email:</label>
                        <input type="text" name="email" class="form-control" aria-describedby="basic-addon1" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input name="email_public" type="checkbox" value="yes"> Make Email Public (Everyone can see your email)
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone Number:</label>
                        <input type="text" name="number" class="form-control" aria-describedby="basic-addon1" value="{{ Input::old('number') }}">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input name="number_public" type="checkbox" value="yes"> Make Number Public (Everyone can see your number)
                            </label>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Step 3/4 - Extended Details</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select name="category" class="form-control">
                            @foreach(ClassifiedCategory::all() as $cat)
                            <option value="{{$cat->id}}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Condition</label>
                        <select name="condition" class="form-control">
                            <option>Brand New</option>
                            <option>New / Never Used</option>
                            <option>Second Hand</option>
                            <option>Damaged / Faulty</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="exampleInputEmail1">Tagline</label>
                        <br>Approximately 50-80 words to catch your buyer's eye
                        <p></p>
                        <input type="text" class="form-control" name="brief-desc" value="{{ Input::old('brief-desc') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea id="summernote" style="height: 12em;" name="description" class="form-control">{{ Input::old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Photos</label>
                        <br>Select up to 10 photos to upload for your ad. Select multiple photos at once.
                        <p></p>
                        <input id="photo-uploader" name="photo-uploader[]" type="file" multiple data-show-upload="false" class="file-loading">
                    </div>
                    <div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; Ads with photos have a better success rate - select multiple photos after you click 'browse'</div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Step 4/4 - Captcha</h3>
                </div>
                <div class="panel-body">
                    <p></p>
                    <div class="g-recaptcha" data-sitekey="6LdxSygTAAAAABadcUg5YRKfKqiZK6a6VuYNICdp"></div>
                    <p></p>
                </div>
            </div>
            <div class="well"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp; Post</button>
                <a href="{{ URL::previous() }}"><button style="float: right;" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Back</button></a></div>
            {{ Form::close() }}
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
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop