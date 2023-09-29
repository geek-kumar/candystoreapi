<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

use Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        return response($customers);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return response($customer);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input,[
            'customer_name' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()],422);
        }

        $customer = Customer::create($input);

        return response($customer,201);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::where('id',$id)->update($request->all());
        $data = Customer::find($id);
        return response()->json(
            [
                'message' => 'Record has been updated' 
            ]); 
    }
}
