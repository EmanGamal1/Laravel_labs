<?php

namespace Database\Seeders;
use App\Models\post;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        post::factory()
        ->count(500)
        ->create([
            'title' => Str::random(10),
            'description' => Str::random(20),
            'created_at' => '2023-04-05'
        ]);
    }
}
