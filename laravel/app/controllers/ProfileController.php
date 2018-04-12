<?php

class ProfileController extends BaseController {

    public function completeProfile()
    {
        $destinationPath = '';
        $filename = '';
        $rules = array(
            'name' => 'required',
            'profile-photo' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else {
        $user = User::find(Auth::user()->id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->website = Input::get('website');
        if (Input::hasFile('profile-photo')) {
            $file = Input::file('profile-photo');
            $image = createImage($file);
            $user->profile_photo = $image;
         }
         if (Input::hasFile('cover-photo')) {
            $file = Input::file('cover-photo');
            $image = createImage($file);
            $user->cover_photo = $image;
        }
        $user->complete_profile = 1;
        $user->save();
        return Redirect::route('profile', array('id'=>Auth::user()->username));
        }
    }
    public function updateProfile()
    {
        $destinationPath = '';
        $filename = '';
        $rules = array(
            'email' => 'required|email'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else {
        $user = User::find(Auth::user()->id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->website = Input::get('website');
         if (Input::hasFile('profile-photo')) {
            $file = Input::file('profile-photo');
            $image = createImage($file);
            $user->profile_photo = $image;
         }
         if (Input::hasFile('cover-photo')) {
            $file = Input::file('cover-photo');
            $image = createImage($file);
            $user->cover_photo = $image;
        }
        $user->complete_profile = 1;
        $user->save();
        return Redirect::route('profile', array('id'=>Auth::user()->username));
        }
    }
    public function showProfileUpdate($username)
    {
        return View::make('profile.update', array('username' => $username));
    }
    public function showProfilePrivacy($username)
    {
        return View::make('profile.privacy', array('username' => $username));
    }    
    public function showWriterHome($username)
    {
        return View::make('profile.writer.home', compact('sidebar', 'new'), array('username' => $username, 'nav' => 'profile.writer.home'));  
    }
    public function showWriterCenter($username)
    {
        return View::make('profile.writer.home', compact('sidebar', 'center'), array('username' => $username, 'nav' => 'profile.writer.new'));  
    }
    public function showProfileCreateAd($username)
    {
        $user = User::where('username', '=', $username)->first();
        return View::make('profile.writer.newad', array('user' => $user));  
    }
    public function showWriterFAQ($username)
    {
        return View::make('profile.writer.home', compact('sidebar', 'faq'), array('username' => $username, 'nav' => 'profile.writer.faq'));  
    }
    public function showArticles($username)
    {
        return View::make('profile.articles', array('username' => $username));  
    }
    public function showProfileGalleries($username)
    {
        return View::make('profile.galleries', array('username' => $username));
    }
    public function showProfileAddGallery($username)
    {
        return View::make('profile.addgallery', array('username' => $username));
    }
    public function addGallery()
    {
        $destinationPath = '';
        $filename = '';
        $rules = array(
            'title' => 'required',
            'uploader' => 'required'
        );
          $messages = array(
            'uploader.required' => 'You forgot to upload photos - please select your photos for this gallery.'
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else {
            $gallery = new Gallery;
            $gallery->name = Input::get('title');
            $gallery->user_id = Auth::user()->id;
            $gallery->private = filter_var(Input::get('public'), FILTER_VALIDATE_BOOLEAN);
            $gallery->save();
            if (Input::hasFile('uploader')) {
                $files = Input::file('uploader'); 
                $destinationPath = public_path().'/uploaded/images/';
                foreach($files as $file)
                {
                    $image = createImage($file);
                    $adphoto = new GalleryPhoto;
                    $adphoto->gallery_id = $gallery->id;
                    $adphoto->photo_id = $image;
                    $adphoto->save();
                }        
            }
            $displaypic = GalleryPhoto::where('gallery_id', '=', $gallery->id)->first();
            $gallery->displayphoto_id = $displaypic->photo_id;
            $gallery->save();
            return Redirect::route('gallery', array('id' => $gallery->id))->with('message', 'You have added a new gallery. We have selected a photo to display for your gallery automatically - feel free to change this later.');
        }
    }
    public function completeProfilePrivacy()
    {
        $user = User::find(Auth::user()->id);
        $privacy = $user->privacy()->first();
        if($privacy === null)
        {
            $privacy = new Privacy;
            $privacy->user_id = Auth::user()->id;
        }
        if(Input::get('show-name') == 'yes')
        {
            $privacy->show_name = 1;
            } else { $privacy->show_name = 0; 
        }
        if(Input::get('email-public') == 'yes')
        {
            $privacy->email_public = 1;
            } else { $privacy->email_public = 0; 
        }
        if(Input::get('email-friends') == 'yes')
        {
            $privacy->email_friends = 1;
            } else { $privacy->email_friends = 0; 
        }
        if(Input::get('website-public') == 'yes')
        {
            $privacy->website_public = 1;
            } else { $privacy->website_public = 0; 
        } 
         if(Input::get('website-friends') == 'yes')
        {
            $privacy->website_friends = 1;
            } else { $privacy->website_friends = 0; 
        }
         if(Input::get('messages') == 'yes')
        {
            $privacy->messages = 1;
            } else { $privacy->messages = 0; 
        }  
        $privacy->save();
        return Redirect::route('profile.privacy', array('id'=>Auth::user()->username));
    }
    
    public function submitArticle()
    {
         $rules = array(
            'title' => 'required',
            'description' => 'required|max:200',
            'article-uploader' => 'required',
            'summernote-1' => 'required'
        );
        $messages = array(
            'summernote-1.required' => 'The article body field is required.',
            'article-uploader.required' => 'You must upload an image for your article.',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
        $destinationPath = '';
        $filename = '';
        $article = new Article;
        $body = new ArticleBody;
        $article->title = Input::get('title');
        $article->stripped_title = clean(Input::get('title'));
        $article->description = Input::get('description');
        $article->author_id = Auth::user()->id;
        $article->category_id = Input::get('category');
        if (Input::hasFile('article-uploader')) {
            $file            = Input::file('article-uploader');
            $image = createImage($file);
            $article->cover_photo = $image;
        }
        $article->save();
        $body->article_id = $article->id;
        $body->save();
        $article->body_id = $body->id;
        $body->text = strip_tags(Input::get('summernote-1'));
        $article->save();
        $body->save();
        return Redirect::route('profile.writer.home', array('username'=>Auth::user()->username));   
        }
    }
    
    public function addArticleImage()
    {
          if (Input::hasFile('file')) {
                $file = Input::file('file');
                $destinationPath = 'uploaded/images/articles/';
                $randomString =  str_random(20) . '_' . str_random(15) . '_' . str_random(20);
                $filename        = $randomString .'.'. $file->getClientOriginalExtension();
                $largefile = $filename;
                Image::make($file)->fit(1200, 800)->save($destinationPath.$filename)->destroy();
                $photo = new Photo;
                $photo->large = $destinationPath.$filename;
                $photo->save();
                return '/e30aus/'.$photo->large;
        }
    }
      
}
