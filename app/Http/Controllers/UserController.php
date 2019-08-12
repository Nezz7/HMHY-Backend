<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class userController extends Controller
{

    public function signup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>  bcrypt($request->input('password')),

        ]);
        $user->save();
        return response()->json(['message' => 'User Created Successfully !!'],201);



    }

    public function signin(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email','password');
        try{
            if (!$token =JWTAuth::attempt($credentials)){
                return response()->json( ['errors' => ['Invalid Credentials']] ,401);
            } }
            catch(JWTException $e){
        return response()->json(['errors' => ['Could not create Token!']],500);

    }
        return response()->json(['token' => $token], 200);
    }




}
