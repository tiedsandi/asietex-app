<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'PT. Busana Indah',      'phone' => '021-6661001', 'email' => 'order@busanaindah.co.id',    'address' => 'Jl. Sudirman No.12, Jakarta Pusat'],
            ['name' => 'CV. Moda Garmen',        'phone' => '022-6662002', 'email' => 'purchasing@modagarmen.com', 'address' => 'Jl. Asia Afrika No.7, Bandung'],
            ['name' => 'PT. Fashion Nusantara',  'phone' => '031-6663003', 'email' => 'info@fashionnus.co.id',     'address' => 'Jl. Basuki Rahmat No.5, Surabaya'],
            ['name' => 'Toko Ritel Tekstil Jaya', 'phone' => '024-6664004', 'email' => 'tekstiljaya@gmail.com',     'address' => 'Pasar Johar Blok B No.22, Semarang'],
            ['name' => 'PT. Export Garmen Indo', 'phone' => '021-6665005', 'email' => 'export@garmenindo.co.id',   'address' => 'Kawasan BIIE, Cikarang, Bekasi'],
        ];

        foreach ($customers as $item) {
            Customer::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
