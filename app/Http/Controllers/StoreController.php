<?php

namespace App\Http\Controllers;
use App\Models\Store;
use Illuminate\Http\Request;

use Validator;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::paginate(5);
        return response($stores);
    }

    public function show($id)
    {
        $store = Store::find($id);
        return response($store);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input,[
            'store_manager_name' => 'required',
            'store_address' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()],422);
        }

        $store = Store::create($input);

        return response($store,201);
    }

    public function update(Request $request, $id)
    {
        $store = Store::where('id',$id)->update($request->all());
        $data = Store::find($id);
        return response()->json(
            [
                'message' => 'Record has been updated' 
            ]); 
    }
}
