@extends('layouts.app')

@section('title', 'Detail Purchase Order')
@section('page-title', 'Transaksi — Detail Purchase Order')

@section('content')
    <div class="flex gap-2 mb-4">
        <a href="{{ route('purchase-orders.index') }}"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
            Kembali
        </a>
        <a href="{{ route('purchase-orders.edit', $purchaseOrder) }}"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
        {{-- Info PO --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h6 class="font-semibold text-gray-700">Informasi PO</h6>
            </div>
            <div class="p-5">
                @php $badge = ['pending'=>'bg-yellow-100 text-yellow-700','received'=>'bg-green-100 text-green-700','cancelled'=>'bg-red-100 text-red-600']; @endphp
                <dl class="space-y-3 text-sm">
                    <div class="flex gap-2">
                        <dt class="w-28 text-gray-400 shrink-0">No. PO</dt>
                        <dd class="font-semibold text-gray-800">{{ $purchaseOrder->po_number }}</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="w-28 text-gray-400 shrink-0">Supplier</dt>
                        <dd class="text-gray-700">{{ $purchaseOrder->supplier->name }}</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="w-28 text-gray-400 shrink-0">Tgl Order</dt>
                        <dd class="text-gray-700">{{ \Carbon\Carbon::parse($purchaseOrder->order_date)->format('d/m/Y') }}
                        </dd>
                    </div>
                    <div class="flex gap-2 items-center">
                        <dt class="w-28 text-gray-400 shrink-0">Status</dt>
                        <dd><span
                                class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $badge[$purchaseOrder->status] ?? 'bg-gray-100 text-gray-600' }}">{{ ucfirst($purchaseOrder->status) }}</span>
                        </dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="w-28 text-gray-400 shrink-0">Catatan</dt>
                        <dd class="text-gray-600">{{ $purchaseOrder->notes ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- Detail Produk --}}
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h6 class="font-semibold text-gray-700">Detail Produk</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium w-8">#</th>
                            <th class="px-4 py-3 text-left font-medium">Produk</th>
                            <th class="px-4 py-3 text-right font-medium">Qty</th>
                            <th class="px-4 py-3 text-right font-medium">Harga Satuan</th>
                            <th class="px-4 py-3 text-right font-medium">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($purchaseOrder->details as $i => $detail)
                            <tr>
                                <td class="px-4 py-3 text-gray-500">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $detail->product->name }}</td>
                                <td class="px-4 py-3 text-right text-gray-600">{{ $detail->quantity }}
                                    {{ $detail->product->unit }}</td>
                                <td class="px-4 py-3 text-right text-gray-600">Rp
                                    {{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right font-semibold text-gray-800">Rp
                                    {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-right font-bold text-gray-700">Total</td>
                            <td class="px-4 py-3 text-right font-bold text-gray-800">Rp
                                {{ number_format($purchaseOrder->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
