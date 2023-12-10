<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $dummyData = [
      [
        'title' => 'Penyebab dan Cara Mengatasi Kecanduan Game Online',
        'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        'slug' => 'penyebab-dan-cara-mengatasi-kecanduan-game-online',
        'content' => '<h1>Penyebab dan Cara Mengatasi Kecanduan Game Online</h1> <br> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>',
        'article_date' => now(),
        'article_category_id' => 1,
        'user_id' => 1
      ]
    ];

    DB::table('articles')->insert($dummyData);
  }
}
