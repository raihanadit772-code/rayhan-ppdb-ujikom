<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = [
            [
                'kode' => 'RPL',
                'nama' => 'Rekayasa Perangkat Lunak',
                'deskripsi' => 'Program keahlian yang fokus pada analisis, desain, implementasi, dan testing software dengan metodologi pengembangan modern.',
                'prospek_kerja' => json_encode(['Software Developer', 'System Analyst', 'Quality Assurance', 'Database Administrator', 'Project Manager']),
                'kuota' => 36,
                'aktif' => true
            ],
            [
                'kode' => 'ANM',
                'nama' => 'Animasi',
                'deskripsi' => 'Program keahlian yang mempelajari teknik animasi 2D dan 3D, motion graphics, dan produksi konten animasi digital.',
                'prospek_kerja' => json_encode(['Animator', '3D Artist', 'Motion Graphics Designer', 'Character Designer', 'VFX Artist']),
                'kuota' => 36,
                'aktif' => true
            ],
            [
                'kode' => 'DKV',
                'nama' => 'Desain Komunikasi Visual',
                'deskripsi' => 'Program keahlian yang mempelajari desain grafis, branding, ilustrasi, dan komunikasi visual untuk media digital dan cetak.',
                'prospek_kerja' => json_encode(['Graphic Designer', 'UI/UX Designer', 'Brand Designer', 'Illustrator', 'Creative Director']),
                'kuota' => 36,
                'aktif' => true
            ],
            [
                'kode' => 'AKT',
                'nama' => 'Akuntansi',
                'deskripsi' => 'Program keahlian yang mempelajari pencatatan, pengelolaan, dan pelaporan keuangan dengan software akuntansi modern.',
                'prospek_kerja' => json_encode(['Staff Accounting', 'Kasir', 'Admin Keuangan', 'Bookkeeper', 'Tax Consultant']),
                'kuota' => 36,
                'aktif' => true
            ],
            [
                'kode' => 'PMR',
                'nama' => 'Pemasaran',
                'deskripsi' => 'Program keahlian yang mempelajari strategi pemasaran, digital marketing, sales, dan manajemen bisnis modern.',
                'prospek_kerja' => json_encode(['Marketing Staff', 'Digital Marketer', 'Sales Representative', 'Social Media Specialist', 'Business Development']),
                'kuota' => 36,
                'aktif' => true
            ]
        ];

        foreach ($jurusan as $data) {
            \App\Models\Jurusan::create($data);
        }
    }
}
