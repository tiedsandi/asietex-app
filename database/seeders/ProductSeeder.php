<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $benang   = Category::where('name', 'Benang')->first();
        $kain     = Category::where('name', 'Kain')->first();
        $garmen   = Category::where('name', 'Garmen')->first();
        $pewarna  = Category::where('name', 'Pewarna')->first();
        $aksesori = Category::where('name', 'Aksesoris')->first();

        $products = [
            ['code' => 'BNG-001', 'name' => 'Benang Katun 30s',       'category_id' => $benang->id,   'unit' => 'kg',  'price' => 45000,  'stock' => 500, 'description' => 'Benang katun combed 30s untuk rajut'],
            ['code' => 'BNG-002', 'name' => 'Benang Polyester 40s',   'category_id' => $benang->id,   'unit' => 'kg',  'price' => 38000,  'stock' => 300, 'description' => 'Benang polyester filamen 40s'],
            ['code' => 'KAI-001', 'name' => 'Kain Katun Poplin',      'category_id' => $kain->id,     'unit' => 'm',   'price' => 25000,  'stock' => 1000, 'description' => 'Kain katun poplin 120gsm'],
            ['code' => 'KAI-002', 'name' => 'Kain Jersey Rayon',      'category_id' => $kain->id,     'unit' => 'm',   'price' => 32000,  'stock' => 800, 'description' => 'Kain jersey rayon lembut'],
            ['code' => 'GAR-001', 'name' => 'Kaos Polos Unisex',      'category_id' => $garmen->id,   'unit' => 'pcs', 'price' => 55000,  'stock' => 200, 'description' => 'Kaos polos cotton combed 24s'],
            ['code' => 'PWR-001', 'name' => 'Zat Warna Reaktif Merah', 'category_id' => $pewarna->id,  'unit' => 'kg',  'price' => 120000, 'stock' => 50,  'description' => 'Reactive dye merah untuk katun'],
            ['code' => 'AKS-001', 'name' => 'Kancing Plastik 4mm',    'category_id' => $aksesori->id, 'unit' => 'grs', 'price' => 5000,   'stock' => 100, 'description' => 'Kancing plastik warna hitam 4mm'],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(['code' => $item['code']], $item);
        }
    }
}
