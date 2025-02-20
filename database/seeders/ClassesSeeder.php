<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('classes')->insert([
            [
                'class_name' => 'XII RPL 1',
                'quota_per_class' => '20',
            ],
        ]);
    }
}

