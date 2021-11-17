<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->paginate();

        return view('user.order.index')->with('orders', $orders);
    }
    
}
