<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah data sudah ada
        if (Cabang::count() == 0) {
            Cabang::create([
                'id' => 1,
                'nama_cabang' => 'Kantor Pusat',
                'alamat' => 'Jl. Utama No. 123, Jakarta',
                'kode_cabang' => 'KP001',
                'fingerprint_active' => true,
            ]);

            Cabang::create([
                'id' => 2,
                'nama_cabang' => 'Cabang Bandung',
                'alamat' => 'Jl. Asia Afrika No. 456, Bandung',
                'kode_cabang' => 'CB002',
                'fingerprint_active' => true,
            ]);

            Cabang::create([
                'id' => 3,
                'nama_cabang' => 'Cabang Surabaya',
                'alamat' => 'Jl. Tunjungan No. 789, Surabaya',
                'kode_cabang' => 'CB003',
                'fingerprint_active' => false,
            ]);
        }
    }
}
