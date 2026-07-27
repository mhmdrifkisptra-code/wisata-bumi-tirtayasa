<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;

class DemoPostSeeder extends Seeder
{
    public function run(): void
    {
        $cat = Category::firstOrCreate(
            ['slug' => 'kegiatan'],
            ['name' => 'Kegiatan']
        );

        for ($i=1; $i<=3; $i++) {
            $title = "Contoh Berita $i Wisata Bumi Tirtayasa";
            Post::create([
                'category_id' => $cat->id,
                'title' => $title,
                'slug' => Str::slug($title)."-".$i,
                'excerpt' => 'Ringkasan berita singkat untuk homepage.',
                'content' => "Ini isi berita contoh ke-$i.\nNanti bisa diganti dari admin.",
                'status' => 'published',
                'published_at' => now(),
            ]);
        }
    }
}
