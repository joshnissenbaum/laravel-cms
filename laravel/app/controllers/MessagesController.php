<?php

class MessagesController extends BaseController {
    
    public function newMessage($username, $to = null)
    {
        return View::make('profile.messenger.create', ['username' => $username, 'to' => $to]);
    }    
    public function showMessages($username)
    {
        $convo = Conversation::forUser(Auth::user()->id)->latest('updated_at')->first();
        if(is_null($convo)) { return View::make('profile.messenger.create', ['username' => $username]); } else {
            return Redirect::route('messages.show', ['username' => Auth::user()->username, 'id' => $convo->id]);
        }
    }
    public function showConversation($username, $id)
    {
        $messages = Message::where('convo_id', '=', $id)->orderBy('created_at', 'DESC')->paginate(10);
        if (Request::ajax()) {
            return Response::json(View::make('profile.messenger.blank_message', array('messages' => $messages))->render());
        }
        return View::make('profile.messenger.show', ['username' => $username, 'convo_id' => $id])->with('messages', $messages);
    }
    public function replyToConversation()
    {
            $rules = array(
                'body' => 'required'
            );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails()) {
                $messages = $validator->messages();
            return Response::json(['status' => 'fail', 'messages' => $messages]);
            /*return Redirect::back()
                ->withErrors($validator)
                ->withInput();*/
            }
            else {
                $message = new Message;
                $message->convo_id = Input::get('convo');
                $message->user_id = Auth::user()->id;
                $message->body = Input::get('body');
                $message->save();
                $convo = Conversation::find($message->convo_id)->touch();
                $photo = asset(Auth::user()->getPhoto(Auth::user()->profile_photo)->thumb);
                $createdAt = Carbon::parse($message->created_at)->diffForHumans();
                Pusherer::trigger('messagesConvo', Input::get('convo'), ['user' => Auth::user()->username, 'body' => Input::get('body'), 'userPhoto' => $photo, 'createdAt' => $createdAt]);
                return Response::json(['status' => 'success']);
                //return Redirect::route('messages.show', ['username' => Auth::user()->username, 'id' => Input::get('convo')]);
            }
    }
    public function storeMessage()
    {
        $rules = array(
                'users' => 'required',
                'message' => 'required'
            );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails()) {
                $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }
            else {
                $usersString = explode(', ', Input::get('users'));
                $usersArray = array();
                array_push($usersArray, Auth::user());
                foreach($usersString as $user)
                {
                    $arrUser = User::where('username', '=', $user)->first();
                    if($arrUser->id == Auth::user()->id) {
                        $validator = "You can't send a message to yourself.";
                        return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
                    }
                    if(is_null($arrUser)) {
                        $validator = $user . " is not a valid username.";
                        return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
                    } else {
                        array_push($usersArray, $arrUser);
                    }                
                }
                $participantIds = array_pluck($usersArray, "id");
                $hasConversation = Participant::whereIn('user_id', $participantIds)
                    ->havingRaw('count(DISTINCT user_id) = '. sizeof($participantIds))
                    ->havingRaw('count(DISTINCT convo_id) = 1')
                    ->groupBy('convo_id')
                    ->first();
                if(is_null($hasConversation) || $hasConversation->count() == 0) {
                    $conversation = new Conversation;
                    $conversation->save();
                    $conversation->addParticipants($usersArray);
                    $message = new Message;
                    $message->convo_id = $conversation->id;
                    $message->user_id = Auth::user()->id;
                    $message->body = Input::get('message');
                    $message->save();
                    return Redirect::route('messages.show', array('username' => Auth::user()->username, 'id' => $conversation->id));  
                } else {
                    $message = new Message;
                    $message->convo_id = $hasConversation->convo_id;
                    $message->user_id = Auth::user()->id;
                    $message->body = Input::get('message');
                    $message->save();
                    return Redirect::route('messages.show', array('username' => Auth::user()->username, 'id' => $hasConversation->convo_id));  
                }
            }
    }
}