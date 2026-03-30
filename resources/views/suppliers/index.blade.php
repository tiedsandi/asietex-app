@extends('layouts.app')

@section('title', 'Supplier')
@section('page-title', 'Master Data — Supplier')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-semibold">Daftar Supplier</h6>
            <a href="{{ route('suppliers.create') }}" class="btn btn-sm text-white" style="background-color: #c0392b;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Supplier
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td>{{ $loop->iteration + ($suppliers->currentPage() - 1) * $suppliers->perPage() }}</td>
                            <td class="fw-semibold">{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone ?? '-' }}</td>
                            <td>{{ $supplier->email ?? '-' }}</td>
                            <td class="text-muted">{{ $supplier->address ?? '-' }}</td>
                            <td>
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus supplier ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data supplier.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($suppliers->hasPages())
            <div class="card-footer bg-white">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
@endsection
