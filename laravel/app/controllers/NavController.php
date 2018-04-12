<?php

class NavController extends BaseController {

    protected $layout = 'layouts.default';
    public function showComingSoon()
    {
        return View::make('comingsoon.index');
    }
    public function showHome()
    {
        return View::make('home.index');
    }
    public function showSearchClassifieds()
    {
        return View::make('pages.classifieds');
    }
    public function showArticles()
    {
        return View::make('pages.articles');
    }
    public function showGalleries()
    {
        $galleries = Gallery::all();
        return View::make('pages.galleries')->with('galleries', $galleries);
    }
    public function showClassifiedResults()
    {
        return View::make('pages.classified-results');
    }
    public function showForum()
    {
        return View::make('forum.home');
    }
    public function showForumPost($id)
    {
        $thread = ForumThread::find($id);
        $mainpost = ForumPost::where('thread_id', '=', $thread->id)->where('main_thread', '=', '1')->first();
        $posts = ForumPost::where('thread_id', '=', $thread->id)->where('main_thread', '=', '0')->orderBy('created_at', 'ASC')->get();
        return View::make('forum.forum_post', array('id' => $id))->with('thread', $thread)->with('mainpost', $mainpost)->with('posts', $posts);
    }
    public function showForumCategory($id)
    {
        $category = ForumCategory::find($id);
        return View::make('forum.category', array('id' => $id))->with('category', $category);
    }
    public function showForumCreateThread()
    {
        return View::make('forum.create-thread');
    }
    public function showForumEditThread($id)
    {
        $thread = ForumThread::find($id);
        return View::make('forum.edit-thread')->with('thread', $thread);
    }
    public function showForumEditPost($id)
    {
        $post = ForumPost::find($id);
        return View::make('forum.edit-post')->with('post', $post);
    }
    public function showForumQuoteReply($thread, $stripped_title, $post)
    {
        $thread = ForumThread::find($thread);
        $post = ForumPost::find($post);
        return View::make('forum.quotereply', compact('thread', 'post'));
    }
    public function showProfile($username)
    {
        $user = User::where('username', '=', $username)->first();
        return View::make('profile.home', array('username' => $username))->with('user', $user);
    }
    public function showClassifiedCreate()
    {
        return View::make('pages.create-classified');
    }
    public function showLogin()
    {
        if(!Auth::check()) { 
	       return View::make('pages.login');
        } else { return View::make('home.index'); }
    }
}
