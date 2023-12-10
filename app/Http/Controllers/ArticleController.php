<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:sanctum')->except('index', 'show');
  }

  public function index(Request $request)
  {
    $articles = Article::query();

    if ($request->withArticleCategory) {
      $articles = $articles->with('article_category');
    }
    if ($request->withUser) {
      $articles = $articles->with('user');
    }

    $articles = $articles->get();

    return response()->json([
      'sucess' => true,
      'message' => 'success get all data article',
      'data' => $articles
    ], 200);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required',
      'excerpt' => 'required',
      'content' => 'required',
      'article_date' => 'required',
      'article_category_id' => 'required'
    ]);
    try {
      $validated['slug'] = \Str::slug($validated['title']);
      $slug = $validated['slug'];
      while (Article::where('slug', $validated['slug'])->first()) {
        $validated['slug'] = $slug . '-' . \Str::random(5);
      }
      $validated['user_id'] = $request->user()->id;
      $article = Article::create($validated);
    } catch (\Exception $e) {
      return response()->json([
        'sucess' => false,
        'message' => $e->getMessage(),
        'data' => null
      ], 400);
    }
    return response()->json([
      'sucess' => true,
      'message' => 'success create article',
      'data' => $article
    ], 200);
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'title' => 'required',
      'excerpt' => 'required',
      'content' => 'required',
      'article_date' => 'required',
      'article_category_id' => 'required'
    ]);

    $article = Article::find($id);
    if (!$article) {
      return response()->json([
        'sucess' => false,
        'message' => 'article with id ' . $id . ' not found',
        'data' => null
      ], 404);
    }
    try {
      $validated['slug'] = \Str::slug($validated['title']);
      $slug = $validated['slug'];
      while (Article::where('slug', $validated['slug'])->where('id', '!=', $id)->first()) {
        $validated['slug'] = $slug . '-' . \Str::random(5);
      }
      $article->update($validated);
    } catch (\Exception $e) {
      return response()->json([
        'sucess' => false,
        'message' => $e->getMessage(),
        'data' => null
      ], 400);
    }

    return response()->json([
      'sucess' => true,
      'message' => 'success update article',
      'data' => $article
    ], 200);
  }

  public function show($id)
  {
    $article = Article::find($id);
    if (!$article) {
      return response()->json([
        'sucess' => false,
        'message' => 'article with id ' . $id . ' not found',
        'data' => null
      ], 404);
    }

    return response()->json([
      'sucess' => true,
      'message' => 'success get detail article',
      'data' => $article
    ], 200);
  }


  public function destroy($id)
  {
    $article = Article::find($id);
    if (!$article) {
      return response()->json([
        'sucess' => false,
        'message' => 'article with id ' . $id . ' not found',
        'data' => null
      ], 404);
    }
    try {
      $article->delete();
    } catch (\Exception $e) {
      return response()->json([
        'sucess' => false,
        'message' => $e->getMessage(),
        'data' => null
      ], 400);
    }

    return response()->json([
      'sucess' => true,
      'message' => 'article with id ' . $id . ' success deleted',
      'data' => null
    ], 200);
  }
}
