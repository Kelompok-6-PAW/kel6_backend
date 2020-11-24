<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User; //import model User
use Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $registrationData = $request->all();
        $validate = Validator::make($registrationData, [
            'username' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required',
            'jenisKelamin'=>'required',
            'tglLahir' => 'required'
        ]); //membuat rule validasi input

        if($validate->fails())
            return response(['message'=> $validate->errors()],400); //retrn eror invalid input
        
        $registrationData['password'] = bcrypt($request->password);//enkripsi password
        $user = User::create($registrationData);//membuat user baru
        return response([
            'message' => 'Register Success',
            'user' => $user,
        ],200); //return data user dalam bentuk json
    }

    public function login(Request $request){
        $loginData = $request->all();
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]); //membuat rule validasi input

        if($validate->fails())
            return response(['message' => $validate->errors()],400); //return invalid input

        if(!Auth::attempt($loginData))
            return response(['message' => 'Invalid Credentials'],401); //return eror gagal login

        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->accessToken; //generate token

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type'=>'Bearer',
            'access_token' => $token
        ]); //retunr data user dan token dalam bentuk json
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
