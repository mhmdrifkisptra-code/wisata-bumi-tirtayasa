<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Profil',
                'slug' => 'profil',
                'content' => '<h2>Profil Wisata Bumi Tirtayasa</h2><p>Silakan ubah isi halaman ini melalui Admin.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Aturan',
                'slug' => 'aturan',
                'content' => '<h2>Aturan Wisata</h2><ul><li>Jagalah kebersihan.</li><li>Dilarang merusak fasilitas.</li></ul>',
                'is_published' => true,
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'content' => '<h2>Kontak</h2><p>Silakan isi informasi kontak.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Peta',
                'slug' => 'peta',
                'content' => '<p>Tempelkan kode Google Maps di sini.</p>',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}