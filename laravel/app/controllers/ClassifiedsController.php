<?php

class ClassifiedsController extends BaseController
{
    
    public function showListing($id)
    {
        $classified = Classified::where('id', '=', $id)->first();
        return View::make('classified.show', array('id' => $id))->with('classified', $classified);
    }
    public function showEditListing($id)
    {
        $classified = Classified::where('id', '=', $id)->first();
        return View::make('classified.edit', array('id' => $id))->with('classified', $classified);
    }
    public function deleteListing($id)
    {
        $classified = Classified::find($id);
        $classified->delete();
        return Redirect::route('classifieds');
    }
    public function deleteListingPhoto($id)
    {
        $photo = ClassifiedPhoto::find($id);
        $listing = Classified::find($photo->classified_id);
        $photo->delete();
        return Redirect::route('listing.edit', array('id' => $listing->id));
    }
    public function search()
    {
        $kw = Input::get('keywords');
        $pricemin = Input::get('price-min');
        $pricemax = Input::get('price-max');
        $category = Input::get('category');
        $location = Input::get('location');
        $radius = Input::get('radius');
        return Redirect::route('classified-results', array('keywords' => $kw, 'pricemin' => $pricemin, 'pricemax' => $pricemax, 'category' => $category, 'location' => $location, 'radius' => $radius));
    }
    public function createAd()
    {
        $rules = array(
            'g-recaptcha-response' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'poster_name' => 'required|max:60',
            'email' => 'required',
            'number' => 'required',
            'location' => 'required',
            'category' => 'required',
            'description' => 'required',
            'brief-desc' => 'required|max:80',
            'condition' => 'required',
        );
         $messages = array(
            'g-recaptcha-response.required' => 'You failed the captcha.',
            'name.required' => 'The title of your product is required.',
            'brief-desc.required' => 'The tagline field is required.',
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
            $name = Input::get('name');
            $price = Input::get('price');
            $location = Input::get('location');
            $description = strip_tags(Input::get('description'));
            $brief_desc = Input::get('brief-desc');
            $condition = Input::get('condition');
            $userid = Auth::user()->id;
            $ad = new Classified;
            $ad->name = $name;
            $ad->price = $price;
            $ad->location = $location;
            $ad->user_id = $userid;
            $ad->poster_name = Input::get('poster_name');
            $ad->email = Input::get('email');
            $ad->email_public = filter_var(Input::get('email_public'), FILTER_VALIDATE_BOOLEAN);
            $ad->number_public = filter_var(Input::get('number_public'), FILTER_VALIDATE_BOOLEAN);
            $ad->phone_number = Input::get('number');
            $ad->category_id = Input::get('category');
            $ad->description = $description;
            $ad->brief_desc = $brief_desc;
            $ad->item_condition = $condition;
            $ad->save();
            if (Input::hasFile('photo-uploader')) {
            $files = Input::file('photo-uploader'); 
            $destinationPath = public_path().'/uploaded/images/';
            foreach($files as $file)
                {
                    $image = createImage($file);
                    $adphoto = new ClassifiedPhoto;
                    $adphoto->classified_id = $ad->id;
                    $adphoto->user_id = $userid;
                    $adphoto->photo_id = $image;
                    $adphoto->save();        
                }        
            }
            else
            {
                    $adphoto = new ClassifiedPhoto;
                    $adphoto->classified_id = $ad->id;
                    $adphoto->user_id = $userid;
                    $adphoto->photo_id = 3;
                    $adphoto->save(); 
            }
            return Redirect::route('listing', array('id' => $ad->id));
            }
        } 
    
        public function updateListing()
        {
            $rules = array(
            'name' => 'required',
            'price' => 'required|numeric',
            'poster_name' => 'required|max:60',
            'email' => 'required',
            'phone_number' => 'required',
            'location' => 'required',
            'category' => 'required',
            'description' => 'required',
            'brief_desc' => 'required|max:80',
            'condition' => 'required',
        );
         $messages = array(
            'g-recaptcha-response.required' => 'You failed the captcha.',
            'name.required' => 'The title of your product is required.',
            'brief-desc.required' => 'The tagline field is required.',
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
            $name = Input::get('name');
            $price = Input::get('price');
            $location = Input::get('location');
            $description = strip_tags(Input::get('description'));
            $brief_desc = Input::get('brief_desc');
            $condition = Input::get('condition');
            $userid = Auth::user()->id;
            $ad = Classified::find(Input::get('classified'));
            $ad->name = $name;
            $ad->price = $price;
            $ad->location = $location;
            $ad->user_id = $userid;
            $ad->poster_name = Input::get('poster_name');
            $ad->email = Input::get('email');
            $ad->email_public = filter_var(Input::get('email_public'), FILTER_VALIDATE_BOOLEAN);
            $ad->number_public = filter_var(Input::get('number_public'), FILTER_VALIDATE_BOOLEAN);
            $ad->phone_number = Input::get('phone_number');
            $ad->category_id = Input::get('category');
            $ad->description = $description;
            $ad->brief_desc = $brief_desc;
            $ad->item_condition = $condition;
            $ad->save();
            if (Input::hasFile('uploader')) {
            $files = Input::file('uploader'); 
            $destinationPath = public_path().'/uploaded/images/';
            foreach($files as $file)
                {
                    $image = createImage($file);
                    $adphoto = new ClassifiedPhoto;
                    $adphoto->classified_id = $ad->id;
                    $adphoto->user_id = $userid;
                    $adphoto->photo_id = $image;
                    $adphoto->save();        
                }        
            }
            else
            {
                    $adphoto = new ClassifiedPhoto;
                    $adphoto->classified_id = $ad->id;
                    $adphoto->user_id = $userid;
                    $adphoto->photo_id = 3;
                    $adphoto->save(); 
            }
            return Redirect::route('listing', array('id' => $ad->id));
            }
        }
}