@extends('layouts.app')

@section('title', 'Buat Sales Order')
@section('page-title', 'Transaksi — Buat Sales Order')

@section('content')
    <form action="{{ route('sales-orders.store') }}" method="POST" id="soForm">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-semibold">Informasi Sales Order</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Customer <span class="text-danger">*</span></label>
                                <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Customer --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Tanggal Order <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="order_date" class="form-control"
                                    value="{{ old('order_date', date('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    </option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Catatan</label>
                                <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h6 class="mb-0 fw-semibold">Detail Produk</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRow()">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Baris
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="35%">Produk</th>
                                    <th width="15%">Qty</th>
                                    <th width="20%">Harga Satuan (Rp)</th>
                                    <th width="20%" class="text-end">Subtotal</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody id="detailBody">
                                <tr id="row-0">
                                    <td>
                                        <select name="details[0][product_id]" class="form-select form-select-sm" required
                                            onchange="fillPrice(this, 0)">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                    {{ $product->name }} ({{ $product->unit }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" name="details[0][quantity]"
                                            class="form-control form-control-sm qty" min="1" value="1" required
                                            oninput="calcSubtotal(0)"></td>
                                    <td><input type="number" name="details[0][unit_price]"
                                            class="form-control form-control-sm price" min="0" value="0"
                                            required oninput="calcSubtotal(0)"></td>
                                    <td class="text-end align-middle"><span class="subtotal fw-semibold">Rp 0</span></td>
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="removeRow(0)"><i class="bi bi-trash"></i></button></td>
                                </tr>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total</td>
                                    <td class="text-end fw-bold" id="grandTotal">Rp 0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" id="btnSubmit" class="btn text-white" style="background-color: #c0392b;">
                    <i class="bi bi-check-lg me-1"></i> Simpan SO
                </button>
                <a href="{{ route('sales-orders.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        let rowCount = 1;
        @php $productData = $products->map(fn($p) => ['id' => $p->id, 'name' => $p->name, 'price' => $p->price, 'unit' => $p->unit])->values(); @endphp
        const products = {!! json_encode($productData) !!};

        function productOptions(selectedId = '') {
            return products.map(p =>
                `<option value="${p.id}" data-price="${p.price}" ${p.id == selectedId ? 'selected' : ''}>${p.name} (${p.unit})</option>`
            ).join('');
        }

        function addRow() {
            const idx = rowCount++;
            const tr = document.createElement('tr');
            tr.id = `row-${idx}`;
            tr.innerHTML = `
            <td><select name="details[${idx}][product_id]" class="form-select form-select-sm" required onchange="fillPrice(this, ${idx})"><option value="">-- Pilih Produk --</option>${productOptions()}</select></td>
            <td><input type="number" name="details[${idx}][quantity]" class="form-control form-control-sm qty" min="1" value="1" required oninput="calcSubtotal(${idx})"></td>
            <td><input type="number" name="details[${idx}][unit_price]" class="form-control form-control-sm price" min="0" value="0" required oninput="calcSubtotal(${idx})"></td>
            <td class="text-end align-middle"><span class="subtotal fw-semibold">Rp 0</span></td>
            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(${idx})"><i class="bi bi-trash"></i></button></td>
        `;
            document.getElementById('detailBody').appendChild(tr);
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
        document.getElementById('soForm').addEventListener('submit', function(e) {
            if (submitted) {
                e.preventDefault();
                return;
            }
            submitted = true;
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        });
    </script>
@endsection
