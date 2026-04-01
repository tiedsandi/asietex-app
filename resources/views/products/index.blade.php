@extends('layouts.app')

@section('title', 'Produk')
@section('page-title', 'Master Data — Produk')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100">
            <h6 class="font-semibold text-gray-700">Daftar Produk</h6>
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center gap-1.5 bg-[#c0392b] hover:bg-[#a93226] text-white text-sm font-medium px-3 py-1.5 rounded-lg transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Produk
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left font-medium w-12">#</th>
                        <th class="px-5 py-3 text-left font-medium">Kode</th>
                        <th class="px-5 py-3 text-left font-medium">Nama Produk</th>
                        <th class="px-5 py-3 text-left font-medium">Kategori</th>
                        <th class="px-5 py-3 text-left font-medium">Satuan</th>
                        <th class="px-5 py-3 text-left font-medium">Harga</th>
                        <th class="px-5 py-3 text-left font-medium">Stok</th>
                        <th class="px-5 py-3 text-left font-medium w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-gray-500">
                                {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                            <td class="px-5 py-3">
                                <span
                                    class="text-xs font-semibold bg-gray-100 text-gray-600 px-2 py-0.5 rounded">{{ $product->code }}</span>
                            </td>
                            <td class="px-5 py-3 font-semibold text-gray-800">{{ $product->name }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $product->unit }}</td>
                            <td class="px-5 py-3 text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <span
                                    class="text-xs font-semibold px-2 py-0.5 rounded-full
                            {{ $product->stock <= 10 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-700' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 transition-colors">
                                        <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')" class="inline">
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
                            <td colspan="8" class="px-5 py-8 text-center text-gray-400">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $products->links() }}</div>
        @endif
    </div>
@endsection
