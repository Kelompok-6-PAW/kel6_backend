<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\TambahNominal;

class TambahNominalController extends Controller
{
    public function index(){
        $nominals = TambahNominal::all();

        if(count($nominals) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $nominals
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }
    

    public function show($id){
        $nominal = TambahNominal::find($id);

        if(!is_null($nominal)){
            return response([
                'message' => 'Retrieve Top Up Success',
                'data' => $nominal
            ],200);
        }

        return response([
            'message' => 'Top Up Not Found',
            'data' => null
        ],404);
    }

   public function store(Request $request) {
       $storeData = $request->all();

       $validate = Validator::make($storeData, [
           'game' => 'required',        
           'topup' => 'required',
           'harga' => 'required|numeric',
           'stok' => 'required|numeric',           
       ]);

       if($validate->fails())
            return response(['message' => $validate->errors()],400);

       $nominal = TambahNominal::create($storeData);
       return response([
        'message' => 'Add Top Up Success',
        'data' => $nominal,
        ],200);
   }

   public function destroy($id){
       $nominal = TambahNominal::find($id);

        if(is_null($nominal)){
            return response([
                'message' => 'Top Up Not Found',
                'data' => null
            ],404);
        }

        if($nominal->delete()){
            return response([
                'message' => 'Delete Top Up Success',
                'data' => $nominal,
            ],200);
        }

        return response([
            'message' => 'Delete Top Up Failed',
            'data' => null,
        ],400);
   }

   public function update(Request $request, $id){
       $nominal = TambahNominal::find($id);
       if(is_null($nominal)){
        return response([
            'message' => 'Top Up Not Found',
            'data' => null
        ],404);
        }

       $updateData = $request->all();
       $validate = Validator::make($updateData, [
        'game' => 'required',        
        'topup' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',        
       ]);

       if($validate->fails())
            return response(['message' => $validate->errors()],400);

       
       $nominal->game = $updateData['game'];
       $nominal->topup = $updateData['topup'];
       $nominal->harga = $updateData['harga'];
       $nominal->stok = $updateData['stok'];

       if($nominal->save()){
            return response([
                'message' => 'Update Top Up Success',
                'data' => $nominal,
                ],200);
       }

       return response([
        'message' => 'Updated Top Up Failed',
        'data' => null,
        ],400);
   }
}
