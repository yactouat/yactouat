<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceived;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'message' => 'required|min:3',
        ]);
        
        if ($validator->fails()) {
            session()->flash('message.error', 'message too short');
            return back()->withInput()->withErrors([
                'message' => 'message too short',
            ]);
        }

        $user = auth()->user();

        $message = new Message();
        $message->from_user_id = $user->id;
        $mailToUser = User::where('email', config('mail.reply_to.address'))->first();
        $message->to_user_id = $mailToUser->id;
        $userMessage = request('message');
        $message->body = $userMessage;
        $message->save();

        Mail::mailer('sendgrid')->to(config('mail.reply_to.address'))->send(new MessageReceived($user, $userMessage));

        session()->flash('message.success', 'message successfully sent!');
        return back();
    }
}
