<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:sanctum')->except('index', 'show');
  }

  public function index()
  {
    $articleCategories = ArticleCategory::all();

    return response()->json([
      'sucess' => true,
      'message' => 'success get data article category',
      'data' => $articleCategories
    ], 200);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|unique:article_categories'
    ]);

    $articleCategory = new ArticleCategory();
    $articleCategory->name = $request->name;
    $articleCategory->save();

    return response()->json([
      'sucess' => true,
      'message' => 'success create article category',
      'data' => $articleCategory
    ], 200);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|unique:article_categories,name,' . $id
    ]);

    $articleCategory = ArticleCategory::find($id);
    if (!$articleCategory) {
      return response()->json([
        'sucess' => false,
        'message' => 'category with id ' . $id . ' not found',
        'data' => null
      ], 404);
    }
    $articleCategory->name = $request->name;
    $articleCategory->update();

    return response()->json([
      'sucess' => true,
      'message' => 'success update article category',
      'data' => $articleCategory
    ], 200);
  }

  public function show($id)
  {
    $articleCategory = ArticleCategory::find($id);

    if (!$articleCategory) {
      return response()->json([
        'sucess' => false,
        'message' => 'category with id ' . $id . ' not found',
        'data' => null
      ], 404);
    }

    return response()->json([
      'sucess' => true,
      'message' => 'success get detail article category',
      'data' => $articleCategory
    ], 200);
  }

  public function destroy($id)
  {
    $articleCategory = ArticleCategory::find($id);
    if (!$articleCategory) {
      return response()->json([
        'sucess' => false,
        'message' => 'category with id ' . $id . ' not found',
        'data' => null
      ], 404);
    }
    $articleCategory->delete();

    return response()->json([
      'sucess' => true,
      'message' => 'category with id ' . $id . ' success deleted',
      'data' => null
    ], 200);
  }
}
