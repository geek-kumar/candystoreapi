<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Order::get()->groupBy(['store_id','status']);
        return response($reports);
    }
}
