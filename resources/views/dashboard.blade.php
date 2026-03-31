@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Row 1: Master Data --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
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
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
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
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
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
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
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

    {{-- Row 2: Transaksi Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="rounded-3 p-3" style="background-color: #f0eafe;">
                            <i class="bi bi-cart-plus fs-4" style="color: #8e44ad;"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Purchase Order</div>
                            <div class="fw-bold fs-4">{{ $totalPO }}</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between text-muted small">
                        <span>Pending: <span class="fw-semibold text-warning">{{ $pendingPO }}</span></span>
                        <a href="{{ route('purchase-orders.index') }}" class="text-decoration-none"
                            style="color: #8e44ad;">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="rounded-3 p-3" style="background-color: #fde8f0;">
                            <i class="bi bi-bag-check fs-4" style="color: #e91e8c;"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Sales Order</div>
                            <div class="fw-bold fs-4">{{ $totalSO }}</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between text-muted small">
                        <span>Pending: <span class="fw-semibold text-warning">{{ $pendingSO }}</span></span>
                        <a href="{{ route('sales-orders.index') }}" class="text-decoration-none"
                            style="color: #e91e8c;">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #eafaf1;">
                        <i class="bi bi-arrow-down-circle fs-4" style="color: #27ae60;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Pembelian (received)</div>
                        <div class="fw-bold">Rp {{ number_format($totalNilaiPO, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background-color: #fdecea;">
                        <i class="bi bi-arrow-up-circle fs-4" style="color: #c0392b;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Penjualan (shipped)</div>
                        <div class="fw-bold">Rp {{ number_format($totalNilaiSO, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: Stok Rendah + Transaksi Terbaru --}}
    <div class="row g-3">
        {{-- Stok Rendah --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle text-danger"></i>
                    <h6 class="mb-0 fw-semibold">Produk Stok Rendah</h6>
                    <span class="badge bg-danger ms-auto">≤ 10</span>
                </div>
                <div class="card-body p-0">
                    @if ($lowStockProducts->isEmpty())
                        <div class="text-center text-muted py-4 small">Semua stok aman ✓</div>
                    @else
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-end">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lowStockProducts as $product)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold small">{{ $product->name }}</div>
                                            <div class="text-muted" style="font-size:0.75rem;">
                                                {{ $product->category->name ?? '-' }}</div>
                                        </td>
                                        <td class="text-end">
                                            <span
                                                class="badge {{ $product->stock == 0 ? 'bg-danger' : 'bg-warning text-dark' }}">
                                                {{ $product->stock }} {{ $product->unit }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        {{-- PO Terbaru --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-semibold">PO Terbaru</h6>
                    <a href="{{ route('purchase-orders.index') }}"
                        class="text-decoration-none small text-muted">Semua</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @forelse($recentPO as $po)
                                <tr>
                                    <td>
                                        <div class="fw-semibold small">{{ $po->po_number }}</div>
                                        <div class="text-muted" style="font-size:0.75rem;">{{ $po->supplier->name }}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        @php $badge = ['pending'=>'warning','received'=>'success','cancelled'=>'danger']; @endphp
                                        <span
                                            class="badge bg-{{ $badge[$po->status] ?? 'secondary' }}">{{ ucfirst($po->status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted py-3 small">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- SO Terbaru --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-semibold">SO Terbaru</h6>
                    <a href="{{ route('sales-orders.index') }}" class="text-decoration-none small text-muted">Semua</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @forelse($recentSO as $so)
                                <tr>
                                    <td>
                                        <div class="fw-semibold small">{{ $so->so_number }}</div>
                                        <div class="text-muted" style="font-size:0.75rem;">{{ $so->customer->name }}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        @php $badge = ['pending'=>'warning','shipped'=>'success','cancelled'=>'danger']; @endphp
                                        <span
                                            class="badge bg-{{ $badge[$so->status] ?? 'secondary' }}">{{ ucfirst($so->status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted py-3 small">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
