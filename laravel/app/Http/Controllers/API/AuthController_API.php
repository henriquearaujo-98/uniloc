<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController_API extends Controller
{
    public function register(Request $request){

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
           'name' => $fields['name'],
           'email' => $fields['email'],
           'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function login(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->with('instituicao')->with('curso')->first();    //Check email

        if(!$user || !Hash::check($fields['password'], $user->password)){   //Check password
            return response([
               'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function logout(Request  $request){
        auth('sanctum')->user()->tokens()->delete();
        return [
            'message' => 'Logged Out'
        ];
    }


    /**
     * Sends code to email for resetting password
     * @throws \Exception
     */
    public function sendResetPasswordEmail(Request $request){

        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::query()->where("email", "=", $request->email)->first();

        if(!$user || !$user->email){
            return \response("Email not found", 404);
        }

        $resetPasswordToken = str_pad(random_int(1, 9999), 4 , '0', STR_PAD_LEFT);

        if(!$userPassReset = PasswordReset::where("email", $user->email)->first()){
            PasswordReset::create([
                "email" => $user->email,
                "token" => $resetPasswordToken
            ]);
        } else {
            $userPassReset->update([
                "email" => $user->email,
                "token" => $resetPasswordToken
            ]);
        }

        $user->notify(
            new ResetPasswordNotification($resetPasswordToken)
        );

        return \response("A code has been sent to your email address", 200);

    }

    /**
     * Checks if entered token corresponds
     * @param Request $request
     * @return void
     */
    public function checkCode(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|string|email',
        ]);

        $user = User::query()->where("email", "=", $request->email)->first();

        $db_token = PasswordReset::where("email", $user->email)->first()->token;

        return $db_token == $request->token;
    }

    /**
     * Perform reset password
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function resetPassword(Request $request){

        $request->validate([
            'token' => 'required',
            'password' => 'required|string',
            'email' => 'required|email'
        ]);

        $attributes = $request->all();

        $user = User::where("email", $attributes["email"])->first();

        if(!$user){
            return \response("No user found", 404);
        }

        $resetRequest = PasswordReset::where("email", $user->email)->first();

        if(!$resetRequest || $resetRequest->token != $request->token){
            return \response("Bad request", 400);
        }


        $user->fill([
            "password" => bcrypt($attributes['password'])
        ]);
        $user->save();

        $user->tokens()->delete();

        $token = $user->createToken("myapptoken")->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $response;

    }


}
