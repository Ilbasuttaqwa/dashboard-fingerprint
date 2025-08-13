<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah data sudah ada
        if (Jabatan::count() == 0) {
            Jabatan::create([
                'id' => 1,
                'nama_jabatan' => 'Admin',
            ]);

            Jabatan::create([
                'id' => 2,
                'nama_jabatan' => 'Manager',
            ]);

            Jabatan::create([
                'id' => 3,
                'nama_jabatan' => 'Staff',
            ]);
        }
    }
}
