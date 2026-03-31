<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use App\Models\Customer;
use App\Models\Product;

class SalesOrderSeeder extends Seeder
{
    public function run(): void
    {
        $customer1 = Customer::where('name', 'PT. Busana Indah')->first();
        $customer2 = Customer::where('name', 'CV. Moda Garmen')->first();
        $kain1     = Product::where('code', 'KAI-001')->first();
        $kain2     = Product::where('code', 'KAI-002')->first();
        $garmen1   = Product::where('code', 'GAR-001')->first();

        $orders = [
            [
                'so' => [
                    'so_number'    => 'SO-20260330-001',
                    'customer_id'  => $customer1->id,
                    'order_date'   => '2026-03-05',
                    'total_amount' => 0,
                    'status'       => 'shipped',
                    'notes'        => 'Pengiriman ke gudang Jakarta',
                ],
                'details' => [
                    ['product_id' => $kain1->id,  'quantity' => 300, 'unit_price' => 28000],
                    ['product_id' => $garmen1->id, 'quantity' => 50,  'unit_price' => 65000],
                ],
            ],
            [
                'so' => [
                    'so_number'    => 'SO-20260330-002',
                    'customer_id'  => $customer2->id,
                    'order_date'   => '2026-03-20',
                    'total_amount' => 0,
                    'status'       => 'pending',
                    'notes'        => null,
                ],
                'details' => [
                    ['product_id' => $kain2->id, 'quantity' => 150, 'unit_price' => 35000],
                ],
            ],
        ];

        foreach ($orders as $order) {
            $total = collect($order['details'])->sum(fn($d) => $d['quantity'] * $d['unit_price']);
            $order['so']['total_amount'] = $total;

            $so = SalesOrder::updateOrCreate(
                ['so_number' => $order['so']['so_number']],
                $order['so']
            );

            $so->details()->delete();
            foreach ($order['details'] as $d) {
                SalesOrderDetail::create([
                    'sales_order_id' => $so->id,
                    'product_id'     => $d['product_id'],
                    'quantity'       => $d['quantity'],
                    'unit_price'     => $d['unit_price'],
                    'subtotal'       => $d['quantity'] * $d['unit_price'],
                ]);
            }
        }
    }
}
