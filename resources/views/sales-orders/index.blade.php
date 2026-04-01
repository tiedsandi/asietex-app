@extends('layouts.app')

@section('title', 'Sales Order')
@section('page-title', 'Transaksi — Sales Order')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100">
            <h6 class="font-semibold text-gray-700">Daftar Sales Order</h6>
            <a href="{{ route('sales-orders.create') }}"
                class="inline-flex items-center gap-1.5 bg-[#c0392b] hover:bg-[#a93226] text-white text-sm font-medium px-3 py-1.5 rounded-lg transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Buat SO Baru
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left font-medium w-12">#</th>
                        <th class="px-5 py-3 text-left font-medium">No. SO</th>
                        <th class="px-5 py-3 text-left font-medium">Customer</th>
                        <th class="px-5 py-3 text-left font-medium">Tgl Order</th>
                        <th class="px-5 py-3 text-left font-medium">Total</th>
                        <th class="px-5 py-3 text-left font-medium">Status</th>
                        <th class="px-5 py-3 text-left font-medium w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php $badge = ['pending'=>'bg-yellow-100 text-yellow-700','shipped'=>'bg-green-100 text-green-700','cancelled'=>'bg-red-100 text-red-600']; @endphp
                    @forelse($salesOrders as $so)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-gray-500">
                                {{ $loop->iteration + ($salesOrders->currentPage() - 1) * $salesOrders->perPage() }}</td>
                            <td class="px-5 py-3 font-semibold text-gray-800">{{ $so->so_number }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $so->customer->name }}</td>
                            <td class="px-5 py-3 text-gray-600">
                                {{ \Carbon\Carbon::parse($so->order_date)->format('d/m/Y') }}</td>
                            <td class="px-5 py-3 text-gray-700">Rp {{ number_format($so->total_amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <span
                                    class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $badge[$so->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($so->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('sales-orders.show', $so) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <a href="{{ route('sales-orders.edit', $so) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 transition-colors">
                                        <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <form action="{{ route('sales-orders.destroy', $so) }}" method="POST"
                                        onsubmit="return confirm('Hapus SO ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-200 text-red-500 hover:bg-red-50 transition-colors">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-gray-400">Belum ada Sales Order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($salesOrders->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $salesOrders->links() }}</div>
        @endif
    </div>
@endsection
