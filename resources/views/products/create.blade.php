@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Master Data — Tambah Produk')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden max-w-2xl">
        <div class="px-5 py-4 border-b border-gray-100">
            <h6 class="font-semibold text-gray-700">Form Tambah Produk</h6>
        </div>
        <div class="p-5">
            <form action="{{ route('products.store') }}" method="POST" id="theForm">
                @csrf
                @php $inp = 'w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#c0392b]/40'; @endphp
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Produk <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="code" value="{{ old('code') }}" placeholder="BNG-001" required
                            class="{{ $inp }} {{ $errors->has('code') ? 'border-red-400 bg-red-50' : '' }}">
                        @error('code')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="{{ $inp }} {{ $errors->has('name') ? 'border-red-400 bg-red-50' : '' }}">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="category_id" required
                            class="{{ $inp }} {{ $errors->has('category_id') ? 'border-red-400 bg-red-50' : '' }}">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Satuan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="unit" value="{{ old('unit') }}" placeholder="kg / m / pcs"
                            required
                            class="{{ $inp }} {{ $errors->has('unit') ? 'border-red-400 bg-red-50' : '' }}">
                        @error('unit')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp) <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="price" value="{{ old('price', 0) }}" min="0" step="100"
                            required
                            class="{{ $inp }} {{ $errors->has('price') ? 'border-red-400 bg-red-50' : '' }}">
                        @error('price')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Stok Awal <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required
                            class="{{ $inp }} {{ $errors->has('stock') ? 'border-red-400 bg-red-50' : '' }}">
                        @error('stock')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="{{ $inp }}">{{ old('description') }}</textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" id="btnSubmit"
                        class="bg-[#c0392b] hover:bg-[#a93226] text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">Simpan</button>
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let submitted = false;
        document.getElementById('theForm').addEventListener('submit', function(e) {
            if (submitted) {
                e.preventDefault();
                return;
            }
            submitted = true;
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';
        });
    </script>
@endsection
