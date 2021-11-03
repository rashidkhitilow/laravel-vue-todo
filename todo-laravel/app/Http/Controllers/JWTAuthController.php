<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JWTAuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);
        $user = User::create(array_merge(
            $validator->validate(),
            ['password'=>bcrypt($request->password)]
        ));

        return response()->json([
            'message'=>"successfully registired",
            'user'=>$user
        ],201);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);

        }
        if(!$token=auth()->guard('api')->attempt($validator->validate())){
            return response()->json(['error' => "Unauthorized user login attempt"], 401);
        }
        return $this->createNewToken($token);
    }

    public function profile(){
        return response()->json(auth()->guard('api')->user());
    }

    public function logout(){
        auth()->guard('api')->logout();
        return response()->json(['message'=>'Succesfully logged out']);
    }
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    public function createNewToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in' =>auth()->guard('api')->factory()->getTTL()*1,
            'user' => auth()->user()
        ]);
    }
}
