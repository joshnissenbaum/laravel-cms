<?php

class GalleryController extends BaseController {

    public function showGallery($id)
    {
        $gallery = Gallery::find($id);
        return View::make('gallery.show')->with('gallery', $gallery);
    }
    public function showGalleryEdit($id)
    {
        $gallery = Gallery::find($id);
        return View::make('gallery.edit')->with('gallery', $gallery);
    }
    public function updateGallery()
    {
         $rules = array(
            'name' => 'required'
            );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }
            else {
                $gallery = Gallery::find(Input::get('gallery'));
                $gallery->name = Input::get('name');
                foreach(Input::get('caption') as $key => $value)
                {
                    $photo = GalleryPhoto::find($key);
                    $photo->caption = $value;
                    $photo->save();
                }
                if (Input::hasFile('uploader'))
                {
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
                $gallery->save();
                return Redirect::route('gallery', array('id' => $gallery->id));
            }
    }
    public function deleteGallery($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        $photos = GalleryPhoto::where('gallery_id', '=', $gallery->id);
        $photos->delete();
        return Redirect::route('profile.galleries', array('username' => Auth::user()->username));
    }
    public function deleteGalleryPhoto($id)
    {
        $photo = GalleryPhoto::find($id);
        $gallery = Gallery::find($photo->gallery_id);
        $photo->delete();
        return Redirect::route('gallery.edit', array('id' => $gallery->id));
    }
      
}
