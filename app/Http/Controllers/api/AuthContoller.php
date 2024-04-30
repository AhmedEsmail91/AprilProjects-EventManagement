<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthContoller extends Controller
{
    public function register(Request $request)
    {
        // Your code here
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // check if the user already exists in the database.
        $user=\App\Models\User::where('email', $request->email)->first();
        
        if($user){
            throw ValidationException::withMessages([
                'email' => ['The email has already been taken.'],
            ]);
        }
        // if the user does not exist in the database, create a new user.
        else{
            $user=new \App\Models\User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();
            return response()->json([
                'message' => 'User created successfully'
            ]);
        }
        
    }
    // Logging in handler method.
    public function login(Request $request)
    {
        // Your code here
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // check the validaty of the user existance in the database.
        $user=\App\Models\User::where('email', $request->email)->first();
        if(!$user){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        // check the password for the given email.
        else{
            // if the hashed password is equal to the password in the database.
            if(Hash::check($request->password, $user->password)){
                $token=$user->createToken($request->email,['Event:index'])->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'message' => 'Success',
                    // 'relation'=> $user->tokens()->latest()
                ]);
            }
            // if the password is not correct throw Validation Exception.
            else{
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials [Password] are incorrect.'],
                ]);
            }
        }

    }

    public function logout(Request $request)
    {
        // Your code here
        $request->user()->tokens()->delete();
        
        // return response()->json(['message' => 'Successfully logged out']);
        return redirect()->route('loggedout.api'); // redirect to the home page.
    }
}
