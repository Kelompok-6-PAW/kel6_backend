<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\PesanTopUp;
use App\Berlangganan;
use App\User; //import model User
use Validator;

class AuthController extends Controller
{
    use VerifiesEmails;
    public $successStatus = 200;

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
        $user->sendApiEmailVerificationNotification();
        $success['message'] = 'link verifikasi telah dikirim ke email anda';
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

        if(Auth::attempt($loginData)){
            $user = Auth::user();
            
            if($user->email_verified_at !== NULL){
                $token = $user->createToken('Authentication Token')->accessToken; //generate token
                return response([
                    'message' => 'Authenticated',
                    'user' => $user,
                    'token_type'=>'Bearer',
                    'access_token' => $token
                ]);
            }else{
                return response()->json(['error'=>'Please Verify Email'], 401);
            }
        }
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);

    }

    public function detailUser()
    {
        $user = Auth::user();
        return response([
            'message' => 'Detail',
            'user' => $user
        ]);
    }

    public function update(Request $request){
        $user = Auth::user();
        if(is_null($user)){
         return response([
             'message' => 'User Not Found',
             'data' => null
         ],404);
         }
 
        $updateData = $request->all();        

        $validate = Validator::make($updateData, [
            'username' => 'required|unique:users',                
            'jenisKelamin' => 'required',
            'tglLahir' => 'required',                
        ]);

        if($validate->fails())
        return response(['message' => $validate->errors()],400);

        $user->username = $updateData['username'];
        $user->jenisKelamin = $updateData['jenisKelamin'];
        $user->tglLahir = $updateData['tglLahir'];            

        if($request->img_user != null){
            $user->img_user = $updateData['img_user'];
        }

        if($request->password != null){
            $user->password = bcrypt($updateData['password']);
        }

        $topups = PesanTopUp::where('uname',$request->usernameLama)->get();
        $langganans = Berlangganan::where('uname',$request->usernameLama)->get();        
        foreach($topups as $topup){
            $topup->uname = $updateData['username'];
            $topup->save();
        }
        foreach($langganans as $langganan){
            $langganan->uname = $updateData['username'];
            $langganan->save();
        }                  
 
        if($user->save()){
             return response([
                 'message' => 'Update User Success',
                 'data' => $user,
                 ],200);
        }
 
        return response([
         'message' => 'Updated User Failed',
         'data' => null,
         ],400);
    }
}
