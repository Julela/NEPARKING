<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('classes')->insert([
            [
                'id' => 1,
                'class_name' => 'XII RPL 1',
                'quota_per_class' => '20',
            ],
            [
                'id' => 2,
                'class_name' => 'XII RPL 2',
                'quota_per_class' => '20',
            ],
        ]);
    }
}

