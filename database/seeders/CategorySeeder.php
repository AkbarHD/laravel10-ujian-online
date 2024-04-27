<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'IPA',
                'slug' => 'ipa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'Matematika',
                'slug' => 'matematika',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'Teknologi Informasi Komunikasi',
                'slug' => 'teknologi-informasi-komunikasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
