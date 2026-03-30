@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #fdecea;">
                        <i class="bi bi-tags fs-4" style="color: #c0392b;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Kategori</div>
                        <div class="fw-bold fs-4">{{ $totalCategories }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #e8f4fd;">
                        <i class="bi bi-box-seam fs-4" style="color: #2980b9;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Produk</div>
                        <div class="fw-bold fs-4">{{ $totalProducts }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #eafaf1;">
                        <i class="bi bi-truck fs-4" style="color: #27ae60;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Supplier</div>
                        <div class="fw-bold fs-4">{{ $totalSuppliers }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #fef9e7;">
                        <i class="bi bi-people fs-4" style="color: #f39c12;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Customer</div>
                        <div class="fw-bold fs-4">{{ $totalCustomers }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #f0eafe;">
                        <i class="bi bi-cart-plus fs-4" style="color: #8e44ad;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Purchase Order</div>
                        <div class="fw-bold fs-4">{{ $totalPurchaseOrders }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #fde8f0;">
                        <i class="bi bi-receipt fs-4" style="color: #e91e8c;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Sales Order</div>
                        <div class="fw-bold fs-4">{{ $totalSalesOrders }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
