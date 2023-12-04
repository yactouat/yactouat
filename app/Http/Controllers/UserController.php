<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Mail\UserSubscribed;
use App\Mail\UserWelcomed;
use App\Models\User;
use App\Services\NewsletterService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function create()
    {
        return view('user.create');
    }

    public function destroy()
    {
        $user = User::where('id', auth()->user()->id);
        $user->delete();
        auth()->logout();
        session()->flash('user.profile-deletion.success', "account deleted");
        return redirect('/');
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function login() 
    {
        $credentials = [
            'email' => request('email'),
            'password' => request('password'),
        ];

        if (auth()->attempt($credentials)) {
            session()->regenerate();
            session()->flash('user.login.success', 'welcome back!');
            return redirect('/');
        }

        return back()
            ->withInput()
            ->withErrors([
                'email' => 'your provided credentials could not be verified',
            ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function showLogin()
    {
        return view('user.login');
    }

    public function signupForNewsLetter(NewsletterService $newsletterService)
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email:rfc,dns',
        ]);
        $user = auth()->user();

        if ($validator->fails() || !$newsletterService->subscribe($user, request('email'))) {
            session()->flash('user.signupForNewsletter.error', 'wrong email address');
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'wrong email address',
                ]);
        }

        Mail::mailer('sendgrid')->to(config('mail.reply_to.address'))->send(new UserSubscribed($user));

        session()->flash('user.signupForNewsletter.success', 'successful newsletter signup!');
        return back();
    }

    public function store()
    {
        // this redirects back to the form if validation fails
        $email = request('email');
        $name = request('name');
        $password = request('password');
        $username = strtolower(str_replace(' ', '-', $name));
        request()->validate([
            'email' => 'required|email:rfc,dns|unique:users',
            'name' => 'required|min:1|max:255',
            'password' => 'required|min:8|max:255',
        ]);

        $usernameCount = 1;
        $usernameOk = false;
        while(!$usernameOk) {
            $username = $username . '-' . (string) $usernameCount;
            $usernameOk = User::where('username', $username)->count() === 0;
            $usernameCount++;
        }

        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'username' => $username,
        ]);

        auth()->login($user);

        Mail::mailer('sendgrid')->to($email)->send(new UserWelcomed($user));
        Mail::mailer('sendgrid')->to(config('mail.reply_to.address'))->send(new UserRegistered($user));
        
        session()->flash('user.create.success', 'welcome to yactouat.com!');

        return redirect('/');
    }

    public function update()
    {
        // this redirects back to the form if validation fails
        $password = request('password');
        request()->validate([
            'password' => 'required|min:8|max:255'
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        $user->password = $password;

        $user->save();

        session()->flash('user.profile-update.success', 'account data updated!');

        return redirect('/');
    }
}
