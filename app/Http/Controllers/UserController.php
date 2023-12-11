<?php

namespace App\Http\Controllers;

use App\Mail\PasswordForgotten;
use App\Mail\UserRegistered;
use App\Mail\UserSubscribed;
use App\Mail\UserWelcomed;
use App\Models\User;
use App\Services\NewsletterService;
use Illuminate\Http\Request;
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

    public function edit(Request $request)
    {
        // get signed route from db
        if ($request->query('signature')) {
            $signedRouteService = resolve('SignedRouteService');
            $persistedSignedRoute = $signedRouteService->fetch($request);
            if(!$persistedSignedRoute) {
                abort(401);
            }
    
            $signedRouteService->consume($persistedSignedRoute);
        }

        // check if user is logged in
        if (!auth()->check()) {
            return redirect('/login');
        }

        return view('user.edit', [
            'user' => auth()->user(),
        ]);
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

    public function sendPasswordResetLink()
    {
        $credentials = [
            'email' => request('email')
        ];

        // check if user exists
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'your provided credentials could not be verified',
                ]);
        }

        // issue a signed route and save it to db (for unsubscribe link)
        $persistedSignedRoute = resolve('SignedRouteService')->persist($user->id, 'edit', 'user', '/profile');

        // notify user and admin
        Mail::mailer('sendgrid')->to($credentials['email'])->send(new PasswordForgotten($user, $persistedSignedRoute));

        session()->flash('user.sendPasswordResetLink.success', 'check your mailbox 😉');
        return redirect('/');
    }

    public function showLogin()
    {
        return view('user.login');
    }

    public function showForgotPassword()
    {
        return view('user.forgot-password');
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

        // issue a signed route and save it to db (for unsubscribe link)
        $persistedSignedRoute = resolve('SignedRouteService')->persist($user->id, 'edit', 'user', '/profile');

        // notify user and admin
        Mail::mailer('sendgrid')->to($email)->send(new UserWelcomed($user, $persistedSignedRoute));
        Mail::mailer('sendgrid')->to(config('mail.reply_to.address'))->send(new UserRegistered($user));
        
        // redirect to home
        session()->flash('user.create.success', 'welcome to yactouat.com!');
        return redirect('/');
    }

    public function update()
    {
        // this redirects back to the form if validation fails
        $password = request('password');
        request()->validate([
            'password' => 'nullable|min:8|max:255'
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        $user->password = $password ?? $user->password;
        $user->notify_on_blog_post = request('notify_on_blog_post') ? true : false;

        $user->save();

        session()->flash('user.profile-update.success', 'account data updated!');

        return redirect('/');
    }
}
