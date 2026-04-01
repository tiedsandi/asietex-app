@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        @php
            $cards = [
                [
                    'label' => 'Kategori',
                    'value' => $totalCategories,
                    'bg' => 'bg-red-50',
                    'text' => 'text-[#c0392b]',
                    'icon' => 'tag',
                ],
                [
                    'label' => 'Produk',
                    'value' => $totalProducts,
                    'bg' => 'bg-blue-50',
                    'text' => 'text-blue-600',
                    'icon' => 'package',
                ],
                [
                    'label' => 'Supplier',
                    'value' => $totalSuppliers,
                    'bg' => 'bg-green-50',
                    'text' => 'text-green-600',
                    'icon' => 'truck',
                ],
                [
                    'label' => 'Customer',
                    'value' => $totalCustomers,
                    'bg' => 'bg-yellow-50',
                    'text' => 'text-yellow-600',
                    'icon' => 'users',
                ],
            ];
        @endphp
        @foreach ($cards as $card)
            <div class="bg-white rounded-xl shadow-sm p-4 flex items-center gap-3">
                <div class="p-3 rounded-xl {{ $card['bg'] }} shrink-0">
                    <i data-lucide="{{ $card['icon'] }}" class="w-5 h-5 {{ $card['text'] }}"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500">{{ $card['label'] }}</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $card['value'] }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-3 rounded-xl bg-purple-50 shrink-0">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-purple-600"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500">Purchase Order</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $totalPO }}</div>
                </div>
            </div>
            <div class="flex justify-between items-center text-xs text-gray-500">
                <span>Pending: <span class="font-semibold text-yellow-500">{{ $pendingPO }}</span></span>
                <a href="{{ route('purchase-orders.index') }}" class="text-purple-600 hover:underline">Lihat</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-3 rounded-xl bg-pink-50 shrink-0">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-pink-600"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500">Sales Order</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $totalSO }}</div>
                </div>
            </div>
            <div class="flex justify-between items-center text-xs text-gray-500">
                <span>Pending: <span class="font-semibold text-yellow-500">{{ $pendingSO }}</span></span>
                <a href="{{ route('sales-orders.index') }}" class="text-pink-600 hover:underline">Lihat</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 flex items-center gap-3">
            <div class="p-3 rounded-xl bg-green-50 shrink-0">
                <i data-lucide="arrow-down-circle" class="w-5 h-5 text-green-600"></i>
            </div>
            <div>
                <div class="text-xs text-gray-500">Total Pembelian (received)</div>
                <div class="text-sm font-bold text-gray-800">Rp {{ number_format($totalNilaiPO, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 flex items-center gap-3">
            <div class="p-3 rounded-xl bg-red-50 shrink-0">
                <i data-lucide="arrow-up-circle" class="w-5 h-5 text-[#c0392b]"></i>
            </div>
            <div>
                <div class="text-xs text-gray-500">Total Penjualan (shipped)</div>
                <div class="text-sm font-bold text-gray-800">Rp {{ number_format($totalNilaiSO, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i data-lucide="triangle-alert" class="w-4 h-4 text-red-500"></i>
                    <h6 class="text-sm font-semibold text-gray-700">Produk Stok Rendah</h6>
                </div>
                <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold">≤ 10</span>
            </div>
            @if ($lowStockProducts->isEmpty())
                <div class="text-center text-gray-400 text-sm py-8">Semua stok aman ✓</div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                            <tr>
                                <th class="px-4 py-2 text-left font-medium">Produk</th>
                                <th class="px-4 py-2 text-right font-medium">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($lowStockProducts as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2.5">
                                        <div class="font-medium text-gray-800 text-xs">{{ $product->name }}</div>
                                        <div class="text-gray-400 text-xs">{{ $product->category->name ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 py-2.5 text-right">
                                        <span
                                            class="text-xs font-semibold px-2 py-0.5 rounded-full
                                    {{ $product->stock == 0 ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $product->stock }} {{ $product->unit }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                <h6 class="text-sm font-semibold text-gray-700">PO Terbaru</h6>
                <a href="{{ route('purchase-orders.index') }}" class="text-xs text-gray-400 hover:text-gray-600">Semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentPO as $po)
                    <div class="px-4 py-3 flex items-center justify-between hover:bg-gray-50">
                        <div>
                            <div class="text-sm font-semibold text-gray-800">{{ $po->po_number }}</div>
                            <div class="text-xs text-gray-400">{{ $po->supplier->name }}</div>
                        </div>
                        @php $badge = ['pending'=>'bg-yellow-100 text-yellow-700','received'=>'bg-green-100 text-green-700','cancelled'=>'bg-red-100 text-red-600']; @endphp
                        <span
                            class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $badge[$po->status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($po->status) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center text-gray-400 text-sm py-8">Belum ada data.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                <h6 class="text-sm font-semibold text-gray-700">SO Terbaru</h6>
                <a href="{{ route('sales-orders.index') }}" class="text-xs text-gray-400 hover:text-gray-600">Semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentSO as $so)
                    <div class="px-4 py-3 flex items-center justify-between hover:bg-gray-50">
                        <div>
                            <div class="text-sm font-semibold text-gray-800">{{ $so->so_number }}</div>
                            <div class="text-xs text-gray-400">{{ $so->customer->name }}</div>
                        </div>
                        @php $badge = ['pending'=>'bg-yellow-100 text-yellow-700','shipped'=>'bg-green-100 text-green-700','cancelled'=>'bg-red-100 text-red-600']; @endphp
                        <span
                            class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $badge[$so->status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($so->status) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center text-gray-400 text-sm py-8">Belum ada data.</div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
