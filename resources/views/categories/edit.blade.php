@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Master Data — Edit Kategori')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden max-w-xl">
        <div class="px-5 py-4 border-b border-gray-100">
            <h6 class="font-semibold text-gray-700">Form Edit Kategori</h6>
        </div>
        <div class="p-5">
            <form action="{{ route('categories.update', $category) }}" method="POST" id="theForm">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#c0392b]/40
                           {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#c0392b]/40">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" id="btnSubmit"
                        class="inline-flex items-center gap-1.5 bg-[#c0392b] hover:bg-[#a93226] text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('categories.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('theForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';
        });
    </script>
@endsection
