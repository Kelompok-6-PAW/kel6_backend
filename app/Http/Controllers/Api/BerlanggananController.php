<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Berlangganan;

class BerlanggananController extends Controller
{
    public function index(){
        $berlangganans = Berlangganan::all();

        if(count($berlangganans) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $berlangganans
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $berlangganan = Berlangganan::find($id);

        if(!is_null($berlangganan)){
            return response([
                'message' => 'Retrieve Berlangganan Akun Success',
                'data' => $berlangganan
            ],200);
        }

        return response([
            'message' => 'Berlangganan Akun Not Found',
            'data' => null
        ],404);
    }

   public function store(Request $request) {
       $storeData = $request->all();

       $validate = Validator::make($storeData, [
           'aplikasi' => 'required',
           'email' => 'required|email:rfc,dns',
           'jenisLangganan' => 'required',
           'harga' => 'required|numeric',
           'pembayaran' => 'required',
           'uname' => 'required',
           'konfirmasi' => 'required',
       ]);

       if($validate->fails())
            return response(['message' => $validate->errors()],400);

       $berlangganan = Berlangganan::create($storeData);
       return response([
        'message' => 'Add Berlangganan Akun Success',
        'data' => $berlangganan,
        ],200);
   }

   public function destroy($id){
        $berlangganan = Berlangganan::find($id);

        if(is_null($berlangganan)){
            return response([
                'message' => 'Berlangganan Akun Not Found',
                'data' => null
            ],404);
        }

        if($berlangganan->delete()){
            return response([
                'message' => 'Delete Berlangganan Akun Success',
                'data' => $berlangganan,
            ],200);
        }

        return response([
            'message' => 'Delete Berlangganan Akun Failed',
            'data' => null,
        ],400);
   }

   public function update(Request $request, $id){
       $berlangganan = Berlangganan::find($id);
       if(is_null($berlangganan)){
        return response([
            'message' => 'Berlangganan Akun Not Found',
            'data' => null
        ],404);
        }

       $updateData = $request->all();
       $validate = Validator::make($updateData, [
        'aplikasi' => 'required',
        'email' => 'required|email:rfc,dns',
        'jenisLangganan' => 'required',
        'harga' => 'required|numeric',
        'pembayaran' => 'required',
        'uname' => 'required',
        'konfirmasi' => 'required',     
       ]);

       if($validate->fails())
            return response(['message' => $validate->errors()],400);

       
       $berlangganan->aplikasi = $updateData['aplikasi'];
       $berlangganan->email = $updateData['email'];
       $berlangganan->jenisLangganan = $updateData['jenisLangganan'];
       $berlangganan->harga = $updateData['harga'];
       $berlangganan->pembayaran = $updateData['pembayaran'];
       
       if($berlangganan->save()){
            return response([
                'message' => 'Update Berlangganan Akun Success',
                'data' => $berlangganan,
                ],200);
       }

       return response([
        'message' => 'Updated Berlangganan Akun Failed',
        'data' => null,
        ],400);
   }
}
