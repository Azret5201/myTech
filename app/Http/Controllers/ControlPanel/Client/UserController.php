<?php

namespace App\Http\Controllers\ControlPanel\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRefactoringRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    public function profile()
    {
        return view('control_panel.client.auth.profile', ['user' => auth()->user()]);
    }

    public function changePassword(ProfileRefactoringRequest $request): JsonResponse
    {
        $user = Auth::user();
        if ($request->name){
            $user->update(['name' => $request->name]);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return ResponseBuilder::jsonRedirect(route('profile'));


    }
}
