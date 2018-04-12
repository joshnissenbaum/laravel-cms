<?php

class UserController extends BaseController {

    public function createUser()
    {
        if(User::where('username', '=', Input::get('username'))->count() > '0')
        {
           $response = array(
               'success' => false,
               'msg' => 'This username has been taken. Please choose a different one.',
           );
           return Response::json( $response );
        }
        $rules = array(
            'g-recaptcha-response' => 'required',
            'username' => 'required',
            'password' => 'required|max:60',
            'email' => 'required|email',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else {
        $user = new User;
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->email = Input::get('email');
        $user->save();
        $privacy = $user->privacy()->first();
        if($privacy === null)
        {
            $privacy = new Privacy;
            $privacy->user_id = $user->id;
        }
        $privacy->email_public = 0;
        $privacy->email_friends = 0;
        $privacy->website_public = 0;
        $privacy->website_friends = 0;
        $privacy->messages = 1;
        $privacy->save();        
            if(Auth::login($user))
            {
                $response = array(
                'success' => true,
                'msg' => 'Setting created successfully',
            );
            return Response::json( $response );    
            }
        }
    }

    public function loginUser()
    {
       $rules = array(
            'username' => 'required',
            'password' => 'required|max:60'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else {
       $credentials = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );        
        if(Input::get('stay_signed') == 'yes')
            {
                if(Auth::attempt($credentials, true)) {
                $response = array(
                    'success' => true,
                    'msg' => 'Login success - forever',
                );
                return Response::json( $response );
            }
            else {
                $response = array(
                    'success' => false,
                    'msg' => 'Login fail',
                );
                return Response::json( $response );
            }
        }
        else
        {
            if(Auth::attempt($credentials, false)) {
                $response = array(
                    'success' => true,
                    'msg' => 'Login success - short term',
                );
                return Response::json( $response );
            }
            else {
                $response = array(
                    'success' => false,
                    'msg' => 'Login fail',
                );
                return Response::json( $response );
                }
            }
        }      
    }
    
    public function logoutUser()
    {
        Auth::logout();
        return Redirect::to('/');
    }

}
