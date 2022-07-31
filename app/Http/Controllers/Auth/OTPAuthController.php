<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\OTPSms;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OTPAuthController extends Controller
{
     // OTP //
     public function login(Request $request)
     {
         if($request->method() == 'GET'){
             return view('auth.login-mobile');
         }
         $request->validate([
             'phone_number' => 'required|ir_mobile'
         ]);


         try {
             $user = User::where('phone_number' , $request->phone_number)->first();
             $OTPCode = mt_rand(100000 , 999999);
             $loginToken = Hash::make('SDFSDlkf61df@dac%!!asffjyADFVG&&we');
             if($user){
                 $user->update([
                     'otp' => $OTPCode,
                     'login_token' => $loginToken,
                     'provider' => 'phone',
                 ]);
                 $user->notify(new OTPSms($OTPCode));
             }else{
                 $user = User::create([
                     'phone_number' => $request->phone_number,
                     'otp' => $OTPCode,
                     'login_token' => $loginToken,
                     'provider' => 'phone',
                 ]);
                 $user->notify(new OTPSms($OTPCode));
             }

             return response(['login_token' => $loginToken] , 200);

         } catch (\Exception $ex) {
             return response(['errors' => $ex->getMessage()] , 422);
         }
     }

     public function checkOtp(Request $request)
     {
         $request->validate([
             'otp' => 'required|digits:6',
             'login_token' => 'required',
         ]);

         try {
             $user = User::where('login_token' , $request->login_token)->firstOrFail();

             if($user->otp == $request->otp){
                $user->update([
                    'email_verified_at' => Carbon::now(),
                ]);
                 Auth::login($user , $remember = true);
                 return response(['ورود با موفقیت انجام شد'] , 200);
             }else{
                 return response(['errors' => ['otp' => ['کد تاییدیه نادرست است']]] , 422);
             }

         } catch (\Exception $ex) {
             return response(['errors' => $ex->getMessage()] , 422);
         }
     }

     public function resendOtp(Request $request)
     {
         $request->validate([
             'login_token' => 'required'
         ]);


         try {
             $user = User::where('login_token' , $request->login_token)->firstOrFail();
             $OTPCode = mt_rand(100000 , 999999);
             $loginToken = Hash::make('SDFSDlkf61df@dac%!!asffjyADFVG&&we');

             $user->update([
                 'otp' => $OTPCode,
                 'login_token' => $loginToken,
                 'provider' => 'phone',
             ]);
             $user->notify(new OTPSms($OTPCode));

             return response(['login_token' => $loginToken] , 200);

         } catch (\Exception $ex) {
             return response(['errors' => $ex->getMessage()] , 422);
         }
     }
}
