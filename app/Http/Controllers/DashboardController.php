<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalCategories'     => Category::count(),
            'totalProducts'       => Product::count(),
            'totalSuppliers'      => Supplier::count(),
            'totalCustomers'      => Customer::count(),
            'totalPurchaseOrders' => PurchaseOrder::count(),
            'totalSalesOrders'    => SalesOrder::count(),
        ];

        return view('dashboard', $data);
    }
}
