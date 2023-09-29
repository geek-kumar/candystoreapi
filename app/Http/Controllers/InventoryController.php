<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Validator;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::paginate(5);
        //$inventories = Inventory::all();
        return response($inventories);
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);
        return response($inventory);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input,[
            'inventory_name' => 'required',
            'manufacture_date' => 'required',
            'available_quantity' => 'required'

        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()],422);
        }

        $inventory = Inventory::create($input);

        return response($inventory,201);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::where('id',$id)->update($request->all());
        $data = Inventory::find($id);
        return response()->json(
            [
                'message' => 'Record has been updated' 
            ]); 
    }



}
