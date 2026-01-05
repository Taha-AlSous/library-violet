<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['name' => 'أحمد'],
            ['name' => 'سعيد'],
            ['name' => 'محمد'],
            ['name' => 'فارس'],
            ['name' => 'هدى'],
        ];
        Author::insert($authors);
    }
}
