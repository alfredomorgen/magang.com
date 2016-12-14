<?php

use \App\Constant;
use \App\Job_Category;
use Illuminate\Database\Seeder;

class Job_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job_Category::create([
            'name' => 'Administrasi',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Akuntansi/Finansial/Perbankan',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Bangunan/Konstruksi',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Edukasi/Pendidikan',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Hotel/Restoran',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Ilmu Pengetahuan',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Kesehatan/Olahraga',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Komputer/IT',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Manufaktur',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Pelayanan/Jasa',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Penjualan/Marketing',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Seni/Media/Komunikasi',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Teknik',
            'status' => Constant::status_active,
        ]);

        Job_Category::create([
            'name' => 'Lainnya',
            'status' => Constant::status_active,
        ]);
    }
}
