<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $gUser =  Socialite::driver('google')->user();
        } catch (Exception $e) {
            return response()->json('Unauthorized', 401);
        }

        $user = User::firstOrCreate(
            ['email' => $gUser->email],
            [
                'name' => $gUser->name,
                'password' => Hash::make($this->generateRandomString(15)),
                'is_student' => true,
                'is_admin' => false,
            ]
        );

        $token = auth('api')->login($user);

        dd($token);

        return redirect('/')->withCookie(cookie("kepoo", $token, 24 * 60));
    }
}
