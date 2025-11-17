<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
            ->orderBy('publish_date', 'desc')
            ->paginate(6);
            
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $news = News::where('is_published', true)->findOrFail($id);
        $latestNews = News::where('is_published', true)
            ->where('id', '!=', $id)
            ->orderBy('publish_date', 'desc')
            ->take(3)
            ->get();
            
        return view('news.show', compact('news', 'latestNews'));
    }
}