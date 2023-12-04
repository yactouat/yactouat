<?php

namespace App\Http\Controllers;

use App\Mail\CommentPosted;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        $validator = Validator::make(request()->all(), [
            'body' => 'required|min:2',
        ]);
        if ($validator->fails()) {
            session()->flash('post.comment.error', 'comment too short');
            return back()->withInput()->withErrors([
                'body' => 'comment too short',
            ]);
        }

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body'),
        ]);

        $user = auth()->user();
        Mail::mailer('sendgrid')->to(config('mail.reply_to.address'))->send(new CommentPosted($user, $post, request('body')));

        return redirect('/posts/' . $post->slug . '#post-comments')
            ->withInput()
            ->with('post.comment.success', 'comment posted!');
    }
}
