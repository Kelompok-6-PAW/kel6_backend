<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\PesanTopUp;

class PesanTopUpController extends Controller
{
    public function index(){
        $topups = PesanTopUp::all();

        if(count($topups) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $topups
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $topup = PesanTopUp::find($id);

        if(!is_null($topup)){
            return response([
                'message' => 'Retrieve Pesanan Top Up Success',
                'data' => $topup
            ],200);
        }

        return response([
            'message' => 'Pesanan Top Up Not Found',
            'data' => null
        ],404);
    }

   public function store(Request $request) {
       $storeData = $request->all();

       $validate = Validator::make($storeData, [
           'game' => 'required',
           'userID' => 'required',
           'nominal' => 'required',
           'harga' => 'required|numeric',
           'pembayaran' => 'required',
           'uname' => 'required',
           'konfirmasi' => 'required',
       ]);

       if($validate->fails())
            return response(['message' => $validate->errors()],400);

       $topup = PesanTopUp::create($storeData);
       return response([
        'message' => 'Add Pesanan Top Up Success',
        'data' => $topup,
        ],200);
   }

   public function destroy($id){
       $topup = PesanTopUp::find($id);

        if(is_null($topup)){
            return response([
                'message' => 'Pesanan Top Up Not Found',
                'data' => null
            ],404);
        }

        if($topup->delete()){
            return response([
                'message' => 'Delete Pesanan Top Up Success',
                'data' => $topup,
            ],200);
        }

        return response([
            'message' => 'Delete Pesanan Top Up Failed',
            'data' => null,
        ],400);
   }

   public function update(Request $request, $id){
       $topup = PesanTopUp::find($id);
       if(is_null($topup)){
        return response([
            'message' => 'Pesanan Top Up Not Found',
            'data' => null
        ],404);
        }

       $updateData = $request->all();
       $validate = Validator::make($updateData, [
        'game' => 'required',
        'userID' => 'required',
        'nominal' => 'required',
        'harga' => 'required|numeric',
        'pembayaran' => 'required',        
       ]);

       if($validate->fails())
            return response(['message' => $validate->errors()],400);

       
       $topup->game = $updateData['game'];
       $topup->userID = $updateData['userID'];
       $topup->nominal = $updateData['nominal'];
       $topup->harga = $updateData['harga'];
       $topup->pembayaran = $updateData['pembayaran'];
       

       if($topup->save()){
            return response([
                'message' => 'Update Pesanan Top Up Success',
                'data' => $topup,
                ],200);
       }

       return response([
        'message' => 'Updated Pesanan Top Up Failed',
        'data' => null,
        ],400);
   }
}
