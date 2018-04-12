<?php

class ForumController extends BaseController {

    public function replyToThread()
            {
            $rules = array(
            'body' => 'required|min:20'
            );
            $messages = array(
            'body.required' => 'You cannot post an empty reply.',
            'body.min' => 'Your post must be at least 10 characters long.'
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
            $post = new ForumPost;
            $post->thread_id = Input::get('threadid');
            $post->user_id = Auth::user()->id;
            $post->body = strip_tags(Input::get('body'));
            $post->main_thread = 0;
            $post->save();
            $route = URL::route('forumpost', array('id' => $post->thread_id)) . '#' . $post->id; 
            return Redirect::to($route);
            }
        }
        public function quoteReply()
        {
            $rules = array(
            'body' => 'required|min:20'
            );
            $messages = array(
            'body.required' => 'You cannot post an empty reply.',
            'body.min' => 'Your post must be at least 10 characters long.'
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
                $post = new ForumPost;
                $post->thread_id = Input::get('thread');
                $post->user_id = Auth::user()->id;
                $post->body = Input::get('body');
                $post->save();
                $thread = ForumThread::find($post->thread_id);
                return Redirect::route('forumpost', array('id' => $thread->id, 'stripped_title' => $thread->stripped_title));
            }
        }
        public function createThread()
        {
             $rules = array(
            'g-recaptcha-response' => 'required',
            'category' => 'required',
            'title' => 'required|min:5|max:70',
            'create-thread-uploader' => 'required',
            'body' => 'required',
            );
            $messages = array(
            'g-recaptcha-response.required' => 'You failed the captcha.',
            'create-thread-uploader.required' => 'You must upload at least one image for your thread.',
            'body.required' => 'The thread body field is required.',
            );
            $validator = Validator::make(Input::all(), $rules, $messages);
            if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }
            else {
                $destinationPath = '';
                $filename = '';
                $thread = new ForumThread;
                $thread->category_id = Input::get('category');
                $thread->user_id = Auth::user()->id;
                $thread->title = Input::get('title');
                if (Input::hasFile('create-thread-uploader')) {
                    $file            = Input::file('create-thread-uploader');
                    $image = createImage($file);
                    $thread->photo = $image;
                }
                $thread->stripped_title = clean(Input::get('title'));
                $thread->save();
                $post = new ForumPost;
                $post->thread_id = $thread->id;
                $post->body = strip_tags(Input::get('body'));
                $post->user_id = Auth::user()->id;
                $post->main_thread = 1;
                $post->save();
                return Redirect::route('forumpost', array('id' => $thread->id, 'stripped_title' => $thread->stripped_title));
                }
        }
    
        public function editThread() {
            $rules = array(
            'category' => 'required',
            'title' => 'required|min:10|max:70',
            'body' => 'required',
            );
            $messages = array(
            'body.required' => 'The thread body field is required.',
            );
            $validator = Validator::make(Input::all(), $rules, $messages);
            if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }
            else {
                $destinationPath = '';
                $filename = '';
                $thread = ForumThread::find(Input::get('thread'));
                $thread->category_id = Input::get('category');
                $thread->user_id = Auth::user()->id;
                $thread->title = Input::get('title');
                if (Input::hasFile('create-thread-uploader')) {
                    $file            = Input::file('create-thread-uploader');
                    $image = createImage($file);
                    $thread->photo = $image;
                }
                $thread->stripped_title = clean(Input::get('title'));
                $thread->save();
                $post = new ForumPost;
                $post->thread_id = $thread->id;
                $post->body = strip_tags(Input::get('body'));
                $post->user_id = Auth::user()->id;
                $post->main_thread = 1;
                $post->save();
                return Redirect::route('forumpost', array('id' => $thread->id, 'stripped_title' => $thread->stripped_title));
                }
        }
        public function deleteThread($id) {
            $thread = ForumThread::find($id);
            $category = $thread->category_id;
            $thread->delete();
            return Redirect::route('forumcategory', array('id' => $category));
        }
    
        public function editPost() {
            $post = ForumPost::find(Input::get('post'));
            $post->body = Input::get('body');
            $post->save();
            return Redirect::route('forumpost', array('id' => $post->thread_id)) . '#' . $post->id; 
        }
    
        public function deletePost($id) {
            $post = ForumPost::find($id);
            $thread = ForumThread::find($post->thread_id);
            $post->delete();
            return Redirect::route('forumpost', array('id' => $thread->id));
        }
    
        public function postImage()
        {
            if (Input::hasFile('file'))
            {
                $file = Input::file('file');
                $destinationPath = 'uploaded/images/forum/';
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
