@extends('layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Master Data — Kategori')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100">
            <h6 class="font-semibold text-gray-700">Daftar Kategori</h6>
            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center gap-1.5 bg-[#c0392b] hover:bg-[#a93226] text-white text-sm font-medium px-3 py-1.5 rounded-lg transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Kategori
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left font-medium w-12">#</th>
                        <th class="px-5 py-3 text-left font-medium">Nama Kategori</th>
                        <th class="px-5 py-3 text-left font-medium">Deskripsi</th>
                        <th class="px-5 py-3 text-left font-medium w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-gray-500">
                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </td>
                            <td class="px-5 py-3 font-semibold text-gray-800">{{ $category->name }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $category->description ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 transition-colors">
                                        <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        onsubmit="return confirm('Hapus kategori ini?')" class="inline">
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
                            <td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($categories->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $categories->links() }}</div>
        @endif
    </div>
@endsection
