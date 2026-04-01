@extends('layouts.app')

@section('title', 'Buat Purchase Order')
@section('page-title', 'Transaksi — Buat Purchase Order')

@section('content')
    <form action="{{ route('purchase-orders.store') }}" method="POST" id="poForm">
        @csrf
        <div class="space-y-4">
            {{-- Header PO --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h6 class="font-semibold text-gray-700">Informasi Purchase Order</h6>
                </div>
                <div class="p-5 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @php $inp = 'w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#c0392b]/40'; @endphp
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Supplier <span
                                class="text-red-500">*</span></label>
                        <select name="supplier_id" required
                            class="{{ $inp }} {{ $errors->has('supplier_id') ? 'border-red-400' : '' }}">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Order <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}" required
                            class="{{ $inp }}">
                        @error('order_date')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status <span
                                class="text-red-500">*</span></label>
                        <select name="status" required class="{{ $inp }}">
                            @foreach (['pending', 'received', 'cancelled'] as $s)
                                <option value="{{ $s }}"
                                    {{ old('status', 'pending') == $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Catatan</label>
                        <textarea name="notes" rows="2" class="{{ $inp }}">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Detail Produk --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h6 class="font-semibold text-gray-700">Detail Produk</h6>
                    <button type="button" onclick="addRow()"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Tambah Baris
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm" id="detailTable">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium w-[35%]">Produk</th>
                                <th class="px-4 py-3 text-left font-medium w-[15%]">Qty</th>
                                <th class="px-4 py-3 text-left font-medium w-[20%]">Harga Satuan (Rp)</th>
                                <th class="px-4 py-3 text-right font-medium w-[20%]">Subtotal</th>
                                <th class="px-4 py-3 w-[10%]"></th>
                            </tr>
                        </thead>
                        <tbody id="detailBody" class="divide-y divide-gray-50">
                            <tr id="row-0">
                                <td class="px-4 py-2">
                                    <select name="details[0][product_id]"
                                        class="w-full px-2 py-1.5 border border-gray-300 rounded-lg text-sm product-select"
                                        required onchange="fillPrice(this,0)">
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                {{ $product->name }} ({{ $product->unit }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-2"><input type="number" name="details[0][quantity]"
                                        class="w-full px-2 py-1.5 border border-gray-300 rounded-lg text-sm qty"
                                        min="1" value="1" required oninput="calcSubtotal(0)"></td>
                                <td class="px-4 py-2"><input type="number" name="details[0][unit_price]"
                                        class="w-full px-2 py-1.5 border border-gray-300 rounded-lg text-sm price"
                                        min="0" value="0" required oninput="calcSubtotal(0)"></td>
                                <td class="px-4 py-2 text-right font-semibold text-gray-700"><span class="subtotal">Rp
                                        0</span></td>
                                <td class="px-4 py-2 text-center">
                                    <button type="button" onclick="removeRow(0)" class="text-red-400 hover:text-red-600">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right font-bold text-gray-700">Total</td>
                                <td class="px-4 py-3 text-right font-bold text-gray-800" id="grandTotal">Rp 0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" id="btnSubmit"
                    class="bg-[#c0392b] hover:bg-[#a93226] text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">Simpan
                    PO</button>
                <a href="{{ route('purchase-orders.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Batal</a>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        let rowCount = 1;
        @php
            $productData = $products->map(fn($p) => ['id' => $p->id, 'name' => $p->name, 'price' => $p->price, 'unit' => $p->unit])->values();
        @endphp
        const products = {!! json_encode($productData) !!};

        const cellCls = 'w-full px-2 py-1.5 border border-gray-300 rounded-lg text-sm';

        function productOptions(sel = '') {
            return products.map(p =>
                `<option value="${p.id}" data-price="${p.price}" ${p.id==sel?'selected':''}>${p.name} (${p.unit})</option>`
            ).join('');
        }

        function addRow() {
            const idx = rowCount++;
            const tr = document.createElement('tr');
            tr.id = `row-${idx}`;
            tr.className = 'divide-y divide-gray-50';
            tr.innerHTML =
                `
            <td class="px-4 py-2"><select name="details[${idx}][product_id]" class="${cellCls} product-select" required onchange="fillPrice(this,${idx})"><option value="">-- Pilih Produk --</option>${productOptions()}</select></td>
            <td class="px-4 py-2"><input type="number" name="details[${idx}][quantity]" class="${cellCls} qty" min="1" value="1" required oninput="calcSubtotal(${idx})"></td>
            <td class="px-4 py-2"><input type="number" name="details[${idx}][unit_price]" class="${cellCls} price" min="0" value="0" required oninput="calcSubtotal(${idx})"></td>
            <td class="px-4 py-2 text-right font-semibold text-gray-700"><span class="subtotal">Rp 0</span></td>
            <td class="px-4 py-2 text-center"><button type="button" onclick="removeRow(${idx})" class="text-red-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button></td>`;
            document.getElementById('detailBody').appendChild(tr);
            lucide.createIcons();
        }

        function removeRow(idx) {
            if (document.getElementById('detailBody').querySelectorAll('tr').length <= 1) return alert(
                'Minimal harus ada 1 produk.');
            document.getElementById(`row-${idx}`)?.remove();
            calcGrandTotal();
        }

        function fillPrice(select, idx) {
            const price = select.options[select.selectedIndex].dataset.price || 0;
            document.getElementById(`row-${idx}`).querySelector('.price').value = price;
            calcSubtotal(idx);
        }

        function calcSubtotal(idx) {
            const row = document.getElementById(`row-${idx}`);
            if (!row) return;
            const sub = (parseFloat(row.querySelector('.qty').value) || 0) * (parseFloat(row.querySelector('.price')
                .value) || 0);
            row.querySelector('.subtotal').textContent = 'Rp ' + sub.toLocaleString('id-ID');
            calcGrandTotal();
        }

        function calcGrandTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(el => {
                total += parseFloat(el.textContent.replace(/[^0-9]/g, '')) || 0;
            });
            document.getElementById('grandTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        let submitted = false;
        document.getElementById('poForm').addEventListener('submit', function(e) {
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
