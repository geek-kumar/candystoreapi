<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Validator;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(5);
        return response($orders);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return response($order);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input,[
            'customer_id'   => 'required',
            'inventory_id'  => 'required',
            'store_id'   => 'required',
            'quantity'  => 'required',
            'status'   => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()],422);
        }

        $order = Order::create($input);

        return response($order,201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::where('id',$id)->update($request->all());
        $data = Order::find($id);
        return response()->json(
            [
                'message' => 'Record has been updated' 
            ]); 
    }
}
