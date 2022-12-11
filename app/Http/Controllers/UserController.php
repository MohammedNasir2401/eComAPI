<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegistrationValidation;
use App\Http\Requests\VendorRegistration;
use App\Models\User;
use App\Models\Vendor;
use App\Services\UserService;
use App\Services\VendorService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResponseTrait;
    public function register(RegistrationValidation $validatedRequest,UserService $userService)
    {
       $user=  $userService->register($validatedRequest);
        return $this->onSuccess($user);
    }
    public function login(LoginValidation $validatedRequest, UserService $userService)
    {

        if($userService->validatePassword($validatedRequest['email'],$validatedRequest['password'])==true){
            $userData= $userService->fetchUserModelWithToken($validatedRequest['email']);
            return $this->onSuccess($userData);
        }
        else{
            return $this->onError('Invalid credentials');   
        }

    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->onSuccess('Logged out successfully');
      
    }


    public function tokenLogin(UserService $userService)
    {
        $user= $userService->fetchUserModelWithToken(auth()->user()->email);
        return $this->onSuccess($user);
    }

    public function vendorRegistration(VendorRegistration $validatedRequest,UserService $userService, VendorService $vendorService, )
    {

         $user=  $userService->register($validatedRequest);
         
         $vendor= $vendorService->register($validatedRequest,$user->id);
         return $this->onSuccess($vendor);

    }
    public function vendorLogin(LoginValidation $validatedRequest, UserService $userService)
    {
        if($userService->validatePassword($validatedRequest['email'],$validatedRequest['password'])==true){
            $userData= $userService->fetchUserModelWithToken($validatedRequest['email']);
            return $this->onSuccess($userData);
        }
        else{
            return $this->onError('Invalid credentials');   
        }
        
    }

}
