<?php

namespace Database\Seeders;

use App\Models\CommentsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommentsModel::factory(30)->create();
    }
}
