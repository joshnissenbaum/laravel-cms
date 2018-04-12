<div id="bg-blur"></div>  
<div id="hugebox">
        <h1>Complete Your Profile</h1>
        <p>Welcome. Thanks for registering. Please complete your profile so the community can learn more more about you.</p>
        <p></p>
        @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
        <div id="hugebox-form">
         {{ Form::open(array('action' => 'ProfileController@completeProfile', 'id' => 'completeProfileForm', 'files' => true)) }}
            <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ Input::old('name') }}">
          </div>
            <?php if($user->profile_photo == 2) { ?>
             <div class="form-group">
            <label for="exampleInputEmail1">Upload <strong>Profile</strong> Photo</label>
            <input id="profile-photo" name="profile-photo" type="file" multiple=false class="file" data-show-upload="false" data-overwrite-initial="false">
            </div>
            <?php } ?>
            <div class="form-group">
            <label for="exampleInputEmail1">Upload <strong>Cover</strong> Photo</label>
                <p>This should be a large size photo which is used to customise your profile, and add taste. Sizes at or above 1200x800 will display the best.</p>
            <input id="cover-photo" name="cover-photo" type="file" multiple=false class="file" data-show-upload="false" data-overwrite-initial="false">
            </div>
            

          <button type="submit" class="btn btn-primary">Submit</button>
      {{ Form::close() }}
    </div>
    </div>