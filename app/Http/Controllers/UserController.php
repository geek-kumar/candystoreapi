<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

class UserController extends Controller
{
    
    /**
     * Create a new user.
     */
    public function createUser(Request $request)
    {

        $input = $request->all();
        $validation = Validator::make($input,[
            'email' => 'required | email',
            'password' => 'required'

        ]);
        if($validation->fails()){
            return response()->json(['error' => $validation->errors()],422);
        }
    
        $input['password'] = bcrypt($request->password);

        $user = User::create($input);
        if($user)
        {
            $token = $user->createToken('api')->accessToken;
            return response([ 'user' => $user, 'token' => $token],201); 
        }
        return response()->json(['data' => null,'message' => 'User deatils are not valid'  ],422);
       
    }

     /**
     * Logout and Remove the specified resource token.
     */
    public function logoutUser(Request $request)
    {
        if($user = Auth::guard('api')->user())
        {
            $token = $user->token();
            $token->revoke();
            $response = ['message' => 'You have been successfully logged out!'];
            return response($response, 200);
        }
        return response()->json(['data' => null,'message' => 'Unauthorized'  ],401);
        
    }

    /**
     * Validate and login the valid user.
     */
    public function loginUser(Request $request)
    {

        $input = $request->all();
        $validation = Validator::make($input,[
            'email' => 'required | email',
            'password' => 'required'

        ]);
        if($validation->fails()){
            return response()->json(['error' => $validation->errors()],422);
        }
        if(Auth::attempt(['email'=>$input['email'] , 'password' => $input['password'] ])){
            $user = Auth::user();
            $token = $user->createToken('api')->accessToken;
            return response()->json(['user' => $user,'token' => $token ]);
        }
        return response()->json(['data' => null,'message' => 'Unauthorized'  ],401);
    }

    /**
     * Get a valid user details.
     */
    public function getUserDetail(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user)
        {
            return response()->json(['data' => $user ],200);
        }
        return response()->json(['data' => null,'message' => 'Unauthorized'  ],401);
        
    }

}
