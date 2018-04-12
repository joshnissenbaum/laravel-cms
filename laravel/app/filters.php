<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (!Auth::check())
	{ 
        return View::make('pages.login');
	}
});

Route::filter('pauth', function($route, $request, $value)
{
       $requestedId = $route->getParameter('username');
       if(Auth::check() && Auth::user()->username != $requestedId)
       {
           return View::make('errors.403');
       }
 });

Route::filter('article-approved', function($route, $request, $value)
{
       $requestedId = $route->getParameter('id');
       $article = Article::find($requestedId);
       if(is_null($article)) { return View::make('errors.404'); }
        if($article->status != 4 && !Auth::check()) {
            return View::make('errors.403');
        }
       if($article->status != 4 && $article->author_id != Auth::user()->id)
       {
           return View::make('errors.403');
       }
 });

// Protect against users trying to access edit/delete routes
Route::filter('threadOwner', function($route, $request, $value)
{
       $requestedId = $route->getParameter('id');
       $thread = ForumThread::find($requestedId);
       if(is_null($thread)) { return View::make('errors.404'); }
       if($thread->user_id != Auth::user()->id)
       {
           return View::make('errors.403');
       }
 });
Route::filter('postOwner', function($route, $request, $value)
{
       $requestedId = $route->getParameter('id');
       $thread = ForumPost::find($requestedId);
       if(is_null($thread)) { return View::make('errors.404'); }
       if($thread->user_id != Auth::user()->id)
       {
           return View::make('errors.403');
       }
 });
Route::filter('listingOwner', function($route, $request, $value)
{
       $requestedId = $route->getParameter('id');
       $listing = Classified::find($requestedId);
       if(is_null($listing)) { return View::make('errors.404'); }
       if($listing->user_id != Auth::user()->id)
       {
           return View::make('errors.403');
       }
 });
Route::filter('articleOwner', function($route, $request, $value)
{
       $requestedId = $route->getParameter('id');
       $article = Article::find($requestedId);
       if(is_null($article)) { return View::make('errors.404'); }
       if($article->author_id != Auth::user()->id)
       {
           return View::make('errors.403');
       }
 });
Route::filter('galleryOwner', function($route, $request, $value)
{
       $requestedId = $route->getParameter('id');
       $gallery = Gallery::find($requestedId);
       if(is_null($gallery)) { return View::make('errors.404'); }
       if($gallery->user_id != Auth::user()->id)
       {
           return View::make('errors.403');
       }
 });



Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
