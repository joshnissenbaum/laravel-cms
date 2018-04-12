<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//****************************************************************************
// Navigation Routes
//****************************************************************************
//Route::get('/', array('as' => 'home', 'uses' => 'NavController@showComingSoon')); 
Route::get('/', array('as' => 'home', 'uses' => 'NavController@showHome')); 
Route::get('/forum', array('as' => 'forum', 'uses' => 'NavController@showForum'));
Route::get('/articles', array('as' => 'articles', 'uses' => 'NavController@showArticles'));
Route::get('/galleries', array('as' => 'galleries', 'uses' => 'NavController@showGalleries'));
Route::get('/classifieds', array('as' => 'classifieds', 'uses' => 'NavController@showSearchClassifieds'));
Route::get('/login', array('as' => 'login', 'uses' => 'NavController@showLogin'));
Route::get('/classifieds/results', array('as' => 'classified-results', 'uses' => 'NavController@showClassifiedResults'));
          
//****************************************************************************
// Forum Routes
//****************************************************************************
Route::get('/forum/thread/{id}/{stripped_title?}', array('as' => 'forumpost', 'uses' => 'NavController@showForumPost'));
Route::get('/forum/category/{id}', array('as' => 'forumcategory', 'uses' => 'NavController@showForumCategory'));
Route::get('/forum/create/thread', array('before' => 'auth', 'as' => 'forum.createthread', 'uses' => 'NavController@showForumCreateThread'));
Route::get('/forum/edit/thread/{id}', array('before' => 'auth|threadOwner:$id', 'as' => 'forum.editthread', 'uses' => 'NavController@showForumEditThread'));
Route::get('/forum/edit/post/{id}', array('before' => 'auth|postOwner:$id', 'as' => 'forum.editpost', 'uses' => 'NavController@showForumEditPost'));
Route::get('/forum/thread/{thread}/{stripped_title?}/quotereply/{post}', array('before' => 'auth', 'as' => 'forumpost.quotereply', 'uses' => 'NavController@showForumQuoteReply'));
Route::post('/forum/thread/quotereply', array('as' => 'forumpost.quotereply.update', 'uses' => 'ForumController@quoteReply'));
Route::post('/forum/post/edit', array('before' => 'auth', 'before' => 'csrf', 'uses'=>'ForumController@editPost'));
Route::post('/forum/create/post/image', array('uses'=>'ForumController@postImage'));
Route::post('/forum/thread/reply', array('before' => 'auth', 'before' => 'csrf', 'as'=>'replythread', 'uses'=>'ForumController@replyToThread'));
Route::post('/forum/thread/create', array('before' => 'auth', 'before' => 'csrf', 'as'=>'createthread', 'uses'=>'ForumController@createThread'));
Route::post('/forum/thread/edit', array('before' => 'auth', 'before' => 'csrf', 'as'=>'editthread', 'uses'=>'ForumController@editThread'));
Route::get('/forum/delete/thread/{id}', array('before' => 'threadOwner:$id', 'before' => 'auth', 'as'=>'forum.deletethread', 'uses'=>'ForumController@deleteThread'));
Route::get('/forum/delete/post/{id}', array('before' => 'auth|postOwner:$id', 'as'=>'forum.deletepost', 'uses'=>'ForumController@deletePost'));
Route::post('/forum/thread/post/forum-reply/image', array('uses'=>'ForumController@postImage'));
Route::post('/forum/thread/{id}/post/forum-reply/image', array('uses'=>'ForumController@postImage'));

//****************************************************************************
// User Profile Routes
//****************************************************************************
///////////////////////
///////////////////////
Route::get('/profile/{username}', array('as' => 'profile', 'uses' => 'NavController@showProfile'));
Route::get('/profile/{username}/articles', array('as' => 'profile.articles', 'uses' => 'ProfileController@showArticles'));
Route::get('/profile/{username}/update', array('before' => 'auth|pauth:$username', 'as' => 'profile.update', 'uses' => 'ProfileController@showProfileUpdate'));
Route::get('/profile/{username}/galleries', array('as' => 'profile.galleries', 'uses' => 'ProfileController@showProfileGalleries'));
Route::get('/profile/{username}/gallery/add', array('before' => 'auth|pauth:$username', 'as' => 'profile.addgallery', 'uses' => 'ProfileController@showProfileAddGallery'));
Route::post('/profile/gallery/add', array('before' => 'auth', 'uses' => 'ProfileController@addGallery'));
// Writer Center Routes
///////////////////////
Route::get('/profile/{username}/writer/home', array('before' => 'auth|pauth:$username', 'as' => 'profile.writer.home', 'uses' => 'ProfileController@showWriterHome'));
Route::get('/profile/{username}/writer/new', array('before' => 'auth|pauth:$username', 'as' => 'profile.writer.new', 'uses' => 'ProfileController@showWriterCenter'));
Route::get('/profile/{username}/write/classified', array('before' => 'auth|pauth:$username', 'as' => 'profile.writer.newad', 'uses' => 'ProfileController@showProfileCreateAd'));
Route::get('/profile/{username}/writer/faq', array('before' => 'auth|pauth:$username', 'as' => 'profile.writer.faq', 'uses' => 'ProfileController@showWriterFAQ'));
///////////////////////
// Update Profile Routes
///////////////////////
Route::get('/profile/{username}/privacy-settings', array('before' => 'auth|pauth:$username', 'as' => 'profile.privacy', 'uses' => 'ProfileController@showProfilePrivacy'));
Route::post('/user/profile/writer/submit-article', array('before' => 'auth', 'before' => 'csrf', 'as'=>'submitprofilearticle', 'uses'=>'ProfileController@submitArticle'));
Route::post('profile/{username}/writer/post/article/image', array('uses'=>'ProfileController@addArticleImage'));
///////////////////////
// End User Profile Control Routes
///////////////////////
Route::get('logout', array('as'=>'logout','uses'=>'UserController@logoutUser'));
Route::post('createuser', array('before' => 'csrf', 'as'=>'createuser', 'uses'=>'UserController@createUser'));
Route::post('user/login', array('before' => 'csrf', 'as'=>'loginuser', 'uses'=>'UserController@loginUser'));
Route::post('user/profile/update', array('before' => 'csrf', 'as'=>'updateprofile', 'uses'=>'ProfileController@updateProfile'));
Route::post('user/profile/complete', array('before' => 'csrf', 'as'=>'completeprofile', 'uses'=>'ProfileController@completeProfile'));
Route::post('user/profile/privacy-settings/update', array('before' => 'csrf', 'as'=>'completeprofileprivacy', 'uses'=>'ProfileController@completeProfilePrivacy'));
//****************************************************************************
// Messaging Routes
//****************************************************************************
Route::get('profile/{username}/messages', ['before' => 'pauth:$username', 'as' => 'messages', 'uses' => 'MessagesController@showMessages']);
Route::get('profile/{username}/messages/new/{to?}', ['before' => 'pauth:$username', 'as' => 'messages.create', 'uses' => 'MessagesController@newMessage']);
Route::post('profile/messages/store', ['before' => 'csrf', 'as' => 'messages.store', 'uses' => 'MessagesController@storeMessage']);
Route::get('profile/{username}/messages/{id}', ['before' => 'pauth:$username', 'as' => 'messages.show', 'uses' => 'MessagesController@showConversation']);
Route::put('profile/messages/update', ['as' => 'messages.update', 'uses' => 'MessagesController@updateMessage']);
Route::post('profile/messages/reply', ['before' => 'csrf', 'as' => 'messages.reply', 'uses' => 'MessagesController@replyToConversation']);
//****************************************************************************
// Classifieds Routes
//****************************************************************************
Route::get('/classifieds/post-advert', array('before' => 'auth', 'as' => 'listingcreate', 'uses'=>'NavController@showClassifiedCreate'));
Route::get('/classifieds/edit/{id}', array('before' => 'auth|listingOwner:$id', 'as' => 'listing.edit', 'uses'=>'ClassifiedsController@showEditListing'));
Route::post('/classifieds/update', array('as' => 'listing.update', 'uses'=>'ClassifiedsController@updateListing'));
Route::get('/classifieds/{id}/delete', array('before' => 'listingOwner:$id', 'as' => 'listing.delete', 'uses'=>'ClassifiedsController@deleteListing'));
Route::get('/classifieds/photo/{id}/delete', array('as' => 'listing.deletephoto', 'uses'=>'ClassifiedsController@deleteListingPhoto'));
Route::get('/classifieds/{id}', array('as' => 'listing', 'uses'=>'ClassifiedsController@showListing'));
Route::post('classifieds/search/search-results', array('before' => 'csrf', 'as'=>'searchclassifieds', 'uses'=>'ClassifiedsController@search'));
Route::post('classifieds/post-advert/post', array('before' => 'csrf', 'as'=>'createad', 'uses'=>'ClassifiedsController@createAd'));
//****************************************************************************
// Article Routes
//****************************************************************************
Route::get('/article/category/{id}', array('before' => '', 'as' => 'article.category', 'uses' => 'ArticleController@showCategory'));
Route::get('/article/{id}/edit', array('before' => 'articleOwner:$id', 'as' => 'article.edit', 'uses' => 'ArticleController@editArticle'));
Route::get('/article/{id}/delete', array('before' => 'articleOwner:$id', 'as' => 'article.delete', 'uses' => 'ArticleController@deleteArticle'));
Route::get('/article/{id}/{stripped_title?}', array('before' => 'article-approved:$id', 'as' => 'article', 'uses' => 'ArticleController@showArticle'));
Route::post('/article/update', array('before' => '', 'as' => 'article.update', 'uses' => 'ArticleController@updateArticle'));

//****************************************************************************
// Gallery Page Routes
//****************************************************************************
Route::get('/gallery/{id}', array('as' => 'gallery', 'uses' => 'GalleryController@showGallery'));
Route::get('gallery/{id}/edit', array('before' => 'galleryOwner:$id', 'as' => 'gallery.edit', 'uses'=>'GalleryController@showGalleryEdit'));
Route::post('gallery/update', array('as' => 'gallery.update', 'uses'=>'GalleryController@updateGallery'));
Route::get('gallery/{id}/delete', array('before' => 'galleryOwner:$id', 'as' => 'gallery.delete', 'uses'=>'GalleryController@deleteGallery'));
Route::get('gallery/photo/{id}/delete', array('as' => 'gallery.deletephoto', 'uses'=>'GalleryController@deleteGalleryPhoto'));

//****************************************************************************
// Miscellaneous Routes
//****************************************************************************
Route::post('/search', array('uses' => 'MiscController@siteSearch'));
Route::get('/search/locations', array('uses' => 'MiscController@searchLocations'));
Route::get('/users/search/{query}', array('uses' => 'MiscController@searchUsers'));

