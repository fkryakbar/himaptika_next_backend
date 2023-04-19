<?php

namespace Database\Seeders;

use App\Models\AnnouncementModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnnouncementModel::factory(10)->create();
    }
}
