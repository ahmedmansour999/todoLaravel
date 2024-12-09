<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'title' => 'General Tasks',
            'user_id' => 1 ,
            'description' => 'This category includes tasks that are not specific to any other category and cover a broad range of activities.',  // More detailed description
        ]) ;
    }
}
