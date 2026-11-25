<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class PimpinanController extends Controller
{
    public function index(): View
    {
        return view('dashboard.pimpinan', [
            'products' => Product::query()->where('is_active', true)->withSum('inventories', 'quantity')->orderBy('category')->orderBy('name')->get(),
            'orders' => Order::query()->with(['user', 'items'])->latest()->limit(100)->get(),
            'paidOrders' => Order::query()->where('status', Order::PAID)->count(),
            'salesTotal' => Order::query()->where('status', Order::PAID)->sum('total_amount'),
            'picUsers' => User::query()->where('role', 'pic')->orderBy('region')->orderBy('name')->get(),
        ]);
    }
}
