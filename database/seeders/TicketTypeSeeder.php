<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        TicketType::create(['name' => 'Tiket Dewasa', 'price' => 5000, 'is_active' => true]);
        TicketType::create(['name' => 'Tiket Anak', 'price' => 5000, 'is_active' => true]);
        TicketType::create(['name' => 'Kolam Renang', 'price' => 15000, 'is_active' => true]);
    }
}
