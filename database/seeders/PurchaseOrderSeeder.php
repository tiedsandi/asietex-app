<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Supplier;
use App\Models\Product;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        $supplier1 = Supplier::where('name', 'PT. Serat Nusantara')->first();
        $supplier2 = Supplier::where('name', 'CV. Benang Jaya')->first();
        $benang1   = Product::where('code', 'BNG-001')->first();
        $benang2   = Product::where('code', 'BNG-002')->first();
        $kain1     = Product::where('code', 'KAI-001')->first();

        $orders = [
            [
                'po' => [
                    'po_number'    => 'PO-20260330-001',
                    'supplier_id'  => $supplier1->id,
                    'order_date'   => '2026-03-01',
                    'total_amount' => 0,
                    'status'       => 'received',
                    'notes'        => 'Pengiriman bulan Maret',
                ],
                'details' => [
                    ['product_id' => $benang1->id, 'quantity' => 100, 'unit_price' => 45000],
                    ['product_id' => $benang2->id, 'quantity' => 50,  'unit_price' => 38000],
                ],
            ],
            [
                'po' => [
                    'po_number'    => 'PO-20260330-002',
                    'supplier_id'  => $supplier2->id,
                    'order_date'   => '2026-03-15',
                    'total_amount' => 0,
                    'status'       => 'pending',
                    'notes'        => null,
                ],
                'details' => [
                    ['product_id' => $kain1->id,   'quantity' => 200, 'unit_price' => 25000],
                ],
            ],
        ];

        foreach ($orders as $order) {
            $total = collect($order['details'])->sum(fn($d) => $d['quantity'] * $d['unit_price']);
            $order['po']['total_amount'] = $total;

            $po = PurchaseOrder::updateOrCreate(
                ['po_number' => $order['po']['po_number']],
                $order['po']
            );

            $po->details()->delete();
            foreach ($order['details'] as $d) {
                PurchaseOrderDetail::create([
                    'purchase_order_id' => $po->id,
                    'product_id'        => $d['product_id'],
                    'quantity'          => $d['quantity'],
                    'unit_price'        => $d['unit_price'],
                    'subtotal'          => $d['quantity'] * $d['unit_price'],
                ]);
            }
        }
    }
}
