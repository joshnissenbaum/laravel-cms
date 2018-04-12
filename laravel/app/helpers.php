<?php
    function set_active($path, $active = 'active')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
   function clean($string)
   {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return strtolower(preg_replace('/-+/', '-', $string)); // Replaces multiple hyphens with single one.
    }
    function getIPAddress()
    {
        $request = Request::instance();
        $request->setTrustedProxies(array('127.0.0.1'));
        $ip = $request->getClientIp();
        return $ip;
    }
    function createImage($file)
    {
        $destinationPath = 'uploaded/images/large/';
        $randomString =  str_random(20) . '_' . str_random(15) . '_' . str_random(20);
        $filename        = $randomString . '-large.' . $file->getClientOriginalExtension();
        $largefile = $filename;
         Image::make($file)->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath.$filename);  
        $photo = new Photo;
        $photo->large = $destinationPath.$filename;
        // Create thumbnail and mid-size picture
        $destinationPath = 'uploaded/images/mid/';
        $filename        = $randomString . '-mid.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(640, 480, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath.$filename);      
        $photo->mid = $destinationPath.$filename;
        // Create mid-size picture
        $destinationPath = 'uploaded/images/thumb/';
        $filename        = $randomString . '-thumb.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(100, 100, function ($constraint) {
            //$constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath.$filename);      
        $photo->thumb = $destinationPath.$filename;
        $photo->save();
        return $photo->id;
    }   


?>