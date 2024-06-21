<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    private $alatKesehatan = [
        'Alat Diagnostik' => [
            [
                'name' => 'Stetoskop',
                'price' => 500000
            ],
            [
                'name' => 'Sfigmomanometer',
                'price' => 300000
            ],
            [
                'name' => 'Termometer',
                'price' => 100000
            ],
            [
                'name' => 'Elektrokardiogram (EKG)',
                'price' => 2000000
            ],
            [
                'name' => 'Ultrasonografi (USG)',
                'price' => 10000000
            ],
        ],
        'Alat Bedah' => [
            [
                'name' => 'Pisau Bedah (Scalpel)',
                'price' => 50000
            ],
            [
                'name' => 'Gunting Bedah',
                'price' => 100000
            ],
            [
                'name' => 'Forceps',
                'price' => 50000
            ],
            [
                'name' => 'Retractor',
                'price' => 200000
            ],
        ],
        'Alat Laboratorium' => [
            [
                'name' => 'Centrifuge',
                'price' => 5000000
            ],
            [
                'name' => 'Mikroskop',
                'price' => 1000000
            ],
            [
                'name' => 'Spectrophotometer',
                'price' => 5000000
            ],
        ],
        'Alat Terapi' => [
            [
                'name' => 'Nebulizer',
                'price' => 500000
            ],
            [
                'name' => 'Inhaler',
                'price' => 200000
            ],
            [
                'name' => 'Pompa Infus',
                'price' => 1000000
            ],
            [
                'name' => 'Electroconvulsive Therapy (ECT) Machines',
                'price' => 5000000
            ],
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->alatKesehatan as $k => $kategori){
            foreach($kategori as $alat){
                Item::create([
                    'name' => $alat['name'],
                    'price' => $alat['price'],
                    'category_id' => Category::query()
                        ->where('name', $k)
                        ->first()->id
                ]);
            }
        }
    }
}
