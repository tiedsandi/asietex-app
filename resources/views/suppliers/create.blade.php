@extends('layouts.app')

@section('title', 'Tambah Supplier')
@section('page-title', 'Master Data — Tambah Supplier')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden max-w-xl">
        <div class="px-5 py-4 border-b border-gray-100">
            <h6 class="font-semibold text-gray-700">Form Tambah Supplier</h6>
        </div>
        <div class="p-5">
            <form action="{{ route('suppliers.store') }}" method="POST" id="theForm">
                @csrf
                @php $inp = 'w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#c0392b]/40'; @endphp
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Supplier <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="{{ $inp }} {{ $errors->has('name') ? 'border-red-400 bg-red-50' : '' }}">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="021-xxxxxxx"
                        class="{{ $inp }}">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@supplier.com"
                        class="{{ $inp }} {{ $errors->has('email') ? 'border-red-400 bg-red-50' : '' }}">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                    <textarea name="address" rows="3" class="{{ $inp }}">{{ old('address') }}</textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" id="btnSubmit"
                        class="bg-[#c0392b] hover:bg-[#a93226] text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">Simpan</button>
                    <a href="{{ route('suppliers.index') }}"
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
