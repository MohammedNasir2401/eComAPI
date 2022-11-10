<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegistrationValidation;
use App\Models\User;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;
    public function register(RegistrationValidation $validatedRequest,UserService $userService)
    {
        if($userService->checkIfEmailExists($validatedRequest->email)){
            return $this->onError('Email already exists');
        }
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

}
