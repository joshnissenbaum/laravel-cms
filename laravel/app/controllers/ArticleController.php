<?php

class ArticleController extends BaseController {

    public function showArticle($id)
    {
        $article = Article::find($id);
        return View::make('article.show', array('articleid' => $id))->with('article', $article);
    }
    public function editArticle($id)
    {
        $article = Article::find($id);
        return View::make('article.edit', array('articleid' => $id))->with('article', $article);
    }
    public function updateArticle()
    {
        $article = Article::find(Input::get('article'));
        $article->title = Input::get('title');
        $body = ArticleBody::where('article_id', '=', $article->id)->first();
        $body->text = Input::get('body');
        $article->category_id = Input::get('category');
        if (Input::hasFile('uploader')) {
            $file            = Input::file('uploader');
            $image = createImage($file);
            $article->cover_photo = $image;
        }
        $body->save();
        $article->save();
        return Redirect::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title));
    }
    public function deleteArticle($id)
    {
        $article = Article::find($id);
        $article->delete();
        return Redirect::route('profile.writer.home', array('username' => Auth::user()->username));
    }
    public function showCategory($id)
    {
        $category = ArticleCategory::find($id);
        return View::make('article.category')->with('category', $category);
    }
}
