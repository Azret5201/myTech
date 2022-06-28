<?php

namespace App\Http\Controllers\ControlPanel\Client\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('control_panel.client.auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();
        $user = (new User())->storeUser($data);

        $email = $request->get('email');
        Mail::to($email)->send(new VerifyMail($user));

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('email.verify');
        }

        return redirect()->route('cp.client.auth.login.get');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function checkCode(Request $request)
    {
        $user = User::where('code', $request->code)->first();
        if ($user){
            $user->userVerify();
            return redirect()->route('success.verify');
        }
        else
        {
            return redirect()->route('email.verify');
        }
    }

    public function verifyEmail($verification_code)
    {
        $user = User::where('code', $verification_code)->first();
        if (!$user)
        {
            return redirect()->route('cp.client.auth.register.get');
        }
        else
        {
            if ($user->email_verified_at)
            {
                return redirect()->route('email.verify');
            }
            else
            {
                $user->update([
                    'email_verified_at' => Carbon::now(),
                ]);
                return redirect()->route('success.verify');
            }
        }
    }

    public function sendAgain(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user)
        {
            Mail::to($user->email)->send(new VerifyMail($user));
        }
    }
}
