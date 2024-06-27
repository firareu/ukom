<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    private $alatKesehatan = [
        'Alat Diagnostik' => [
            [
                'name' => 'Stetoskop',
                'price' => 475000
            ],
            [
                'name' => 'Sfigmomanometer',
                'price' => 649000
            ],
            [
                'name' => 'Termometer',
                'price' => 249000
            ],
            [
                'name' => 'Elektrokardiogram (EKG)',
                'price' => 87999000
            ],
            [
                'name' => 'Ultrasonografi (USG)',
                'price' => 36999000
            ],
        ],
        'Alat Bedah' => [
            [
                'name' => 'Pisau Bedah (Scalpel)',
                'price' => 12000
            ],
            [
                'name' => 'Gunting Bedah',
                'price' => 149000
            ],
            [
                'name' => 'Forceps',
                'price' => 5399000
            ],
            [
                'name' => 'Retractor',
                'price' => 366300
            ],
        ],
        'Alat Laboratorium' => [
            [
                'name' => 'Centrifuge',
                'price' => 159999000
            ],
            [
                'name' => 'Mikroskop',
                'price' => 13999000
            ],
            [
                'name' => 'Spectrophotometer',
                'price' => 26999000
            ],
        ],
        'Alat Terapi' => [
            [
                'name' => 'Nebulizer',
                'price' => 919000
            ],
            [
                'name' => 'Inhaler',
                'price' => 168700
            ],
            [
                'name' => 'Pompa Infus',
                'price' => 12979000
            ],
            [
                'name' => 'Electroconvulsive Therapy (ECT) Machines',
                'price' => 3644000
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
                $imageName = $this->findImageFile($alat['name']);

                $itemData = [
                    'name' => $alat['name'],
                    'price' => $alat['price'],
                    'category_id' => Category::query()
                        ->where('name', $k)
                        ->first()->id,
                ];

                if ($imageName) {
                    $itemData['image'] = $imageName;
                }

                Item::create($itemData);
            }
        }
    }

    private function findImageFile($itemName): ?string
    {
        $normalizedName = Str::slug($itemName);
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        foreach ($extensions as $ext) {
            // Cek dengan nama yang dinormalisasi
            $fileName = "{$normalizedName}.{$ext}";
            if (File::exists(public_path("img/products/{$fileName}"))) {
                return $fileName;
            }
            
            // Cek dengan nama asli (tanpa normalisasi)
            $originalFileName = str_replace(' ', '-', $itemName) . ".{$ext}";
            if (File::exists(public_path("img/products/{$originalFileName}"))) {
                return $originalFileName;
            }
            
            // Cek dengan nama yang dikapitalisasi
            $capitalizedFileName = str_replace(' ', '-', ucwords($itemName)) . ".{$ext}";
            if (File::exists(public_path("img/products/{$capitalizedFileName}"))) {
                return $capitalizedFileName;
            }
        }
        
        return 'default.jpg'; // Fallback ke gambar default jika tidak ditemukan
    }
}
