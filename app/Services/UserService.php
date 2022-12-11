<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // $user->sendEmailVerificationNotification();
        return $user;

    }
    public function checkIfEmailExists($email)
    {
        if(User::where('email',$email)->first()){
            return true;
        }
        else{
            return false;
        }
    }
    public function validatePassword($email,$password)
    {
        $user = User::where('email',$email)->first();

        if(Hash::check($password,$user->password)){
            return true;
        }
        else{
            return false;
        }
    }

    public function fetchUserModelWithToken($email)
    {
            $user=User::with('vendor')->where('email',$email)->first();
        $data['user'] =$user ;
        $data['token'] =$user->createToken('MyApp')->plainTextToken;
        return $data;
    }



}
