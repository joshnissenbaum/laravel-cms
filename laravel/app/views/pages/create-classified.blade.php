@extends('layouts.default')
@section('content')
   <div class="create-thread">
    <div class="row">
        <div class="col-md-9">
         {{ Form::open(array('action' => 'ClassifiedsController@createAd', 'id' => 'createad', 'files' => 'true')) }}
            <h2><a href="">Classifieds</a> > Post Advert</h2>
            <hr>
            <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">What are you selling?</label>
                <input type="text" class="form-control" name="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">How much are you selling it for?</label>
                <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">$</span>
              <input type="text" name="price" class="form-control" aria-describedby="basic-addon1">
            </div>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">Location of the item</label>
                <input type="text" class="form-control" name="location" placeholder="e.g. Casino, NSW">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Item Category</label>
                <select name="category" class="form-control">
                    @foreach(ClassifiedCategory::all() as $cat)
                        <option value="{{$cat->id}}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Item Condition</label>
                <select name="condition" class="form-control">
                    <option>Brand New</option>
                    <option>New / Never Used</option>
                    <option>Second Hand</option>
                    <option>Damaged / Faulty</option>
                </select>
            </div>
              <div class="form-group" style="margin-top: 15px;">
                <label for="exampleInputEmail1">Brief description of the item</label><br>Approximately 50 words to catch your buyer's eye<p></p>
                <input type="text" class="form-control" name="brief-desc">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Full-length description of the item</label>
                <textarea style="height: 12em;" name="description" class="form-control" placeholder=""></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Photos</label><br>Select up to 10 photos to upload for your ad.<p></p>
                <input id="photo-uploader" name="photo-uploader[]" type="file" multiple class="file-loading">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            {{ Form::close() }}
        </div>


        <div class="col-md-3">
            @include('misc.general-right-column')
        </div>
    </div>
</div>
@stop