<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Order/Index', [
            'orders' => Order::all(),
        ]);
    }

    public function paidOrders()
    {
        return Inertia::render('Admin/Order/Index', [
            'orders' => Order::where('status_payment', 'PAID')->get()
        ]);
    }

    public function pendingOrders()
    {
        return Inertia::render('Admin/Order/Index', [
            'orders' => Order::where('status_payment', 'PENDING')->get()
        ]);
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);

        return Inertia::render('Admin/Order/OrderDetails', [
            'order' => Order::findOrFail($id)
        ]);
    }





    public function edit($id)
    {
        return Inertia::render('Admin/Order/Index', [
            'orders' => Order::findOrFail($id),
        ]);
    }
}
