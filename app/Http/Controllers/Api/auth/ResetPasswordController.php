<?php

namespace App\Http\Controllers\Api\Auth;


use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    protected function sendResetResponse(Request $request){
        //password.reset
        $input = $request->only('email','token', 'password', 'password_confirmation');
        $validator = Validator::make($input, ['token' => 'required','email' => 'required|email','password' => 'required|confirmed|min:8',]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $response = Password::reset($input, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();
         event(new PasswordReset($user));});
            if($response == Password::PASSWORD_RESET){
                $message = "Password reset successfully";
            }else{
                $message = "Email could not be sent to this email address";
            }
            $response = ['data'=>'','message' => $message];
            return response()->json($response);
        }
}
