<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['name' => 'PT. Serat Nusantara',   'phone' => '021-5551001', 'email' => 'info@seratnusantara.co.id',  'address' => 'Jl. Industri No.10, Bandung'],
            ['name' => 'CV. Benang Jaya',        'phone' => '022-5552002', 'email' => 'sales@benangjaya.com',       'address' => 'Jl. Tekstil No.5, Surabaya'],
            ['name' => 'PT. Kimia Warna Prima',  'phone' => '031-5553003', 'email' => 'order@kimiawarna.co.id',     'address' => 'Jl. Kimia Raya No.8, Semarang'],
            ['name' => 'UD. Makmur Bersama',     'phone' => '024-5554004', 'email' => 'makmurbersama@gmail.com',   'address' => 'Jl. Pasar Baru No.3, Jakarta'],
            ['name' => 'PT. Global Textile Ind', 'phone' => '021-5555005', 'email' => 'info@globaltextile.co.id',  'address' => 'Kawasan Industri MM2100, Bekasi'],
        ];

        foreach ($suppliers as $item) {
            Supplier::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
