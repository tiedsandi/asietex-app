@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Master Data — Tambah Kategori')

@section('content')
    <div class="card border-0 shadow-sm" style="max-width: 600px;">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-semibold">Form Tambah Kategori</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="contoh: Benang" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat kategori (opsional)">{{ old('description') }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" id="btnSubmit" class="btn text-white" style="background-color: #c0392b;">
                        <i class="bi bi-check-lg me-1"></i> Simpan
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        });
    </script>
@endsection
