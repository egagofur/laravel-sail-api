<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArticleCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $dummyData = [
      [
        'name' => 'News',
      ],
      [
        'name' => 'Tips & Trick',
      ]
    ];

    DB::table('article_categories')->insert($dummyData);
  }
}
