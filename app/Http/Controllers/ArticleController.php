<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Display a listing of the articles
    public function index()
    {
        $articles = Article::with('user', 'category')->get();
        return response()->json(['articles' => $articles], 200);
    }

    // Store a newly created article in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->contents,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Article created successfully', 'article' => $article], 201);
    }

    // Display the specified article
    public function show(Article $article)
    {
        $article->load('user', 'category'); // Load relationships
        return response()->json(['article' => $article], 200);
    }

    // Update the specified article in storage
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article->update([
            'title' => $request->title,
            'content' => $request->contents,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Article updated successfully', 'article' => $article], 200);
    }

    // Remove the specified article from storage
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully'], 200);
    }
}
