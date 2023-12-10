<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'excerpt',
    'slug',
    'content',
    'article_date',
    'article_category_id',
    'user_id'
  ];

  protected $casts = [
    'article_date' => 'datetime'
  ];

  public function article_category()
  {
    return $this->belongsTo(ArticleCategory::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
