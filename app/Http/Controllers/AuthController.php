<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegistrationValidation;
use App\Http\Requests\VendorRegistration;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseTrait;
    public function register(RegistrationValidation $validatedRequest)
    {
       $user = new User();
        $user->name = $validatedRequest->name;
        $user->email = $validatedRequest->email;
        $user->password = Hash::make($validatedRequest->password);
        $user->save(); 
        return $this->onSuccess($user);
    }
    public function login(LoginValidation $validatedRequest)
    {
        $credentials = $validatedRequest->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) 
            return $this->onError('Invalid Credentials', 401);
        $user = Auth::user();
        $data['user'] =$user ;
        $data['token'] = $token;
        return $this->onSuccess($data);
    }

    public function logout()
    {
        Auth::logout();
        return $this->onSuccess('Logged out successfully');
    }

    public function tokenLogin()
    {
       $user= Auth::user();
        return $this->onSuccess($user);
    }

    public function vendorRegistration(VendorRegistration $validatedRequest )
    {
        $user = new User();
        $user->name = $validatedRequest->name;
        $user->email = $validatedRequest->email;
        $user->password = Hash::make($validatedRequest->password);
        $user->role = 'vendor';
        $user->save(); 

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