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
            // Summary cards
            'totalCategories'  => Category::count(),
            'totalProducts'    => Product::count(),
            'totalSuppliers'   => Supplier::count(),
            'totalCustomers'   => Customer::count(),

            // Transaksi stats
            'totalPO'          => PurchaseOrder::count(),
            'totalSO'          => SalesOrder::count(),
            'pendingPO'        => PurchaseOrder::where('status', 'pending')->count(),
            'pendingSO'        => SalesOrder::where('status', 'pending')->count(),
            'totalNilaiPO'     => PurchaseOrder::where('status', 'received')->sum('total_amount'),
            'totalNilaiSO'     => SalesOrder::where('status', 'shipped')->sum('total_amount'),

            // Produk stok rendah (stok <= 10)
            'lowStockProducts' => Product::with('category')
                ->where('stock', '<=', 10)
                ->orderBy('stock')
                ->get(),

            // Transaksi terbaru
            'recentPO'         => PurchaseOrder::with('supplier')->latest()->take(5)->get(),
            'recentSO'         => SalesOrder::with('customer')->latest()->take(5)->get(),
        ];

        return view('dashboard', $data);
    }
}
