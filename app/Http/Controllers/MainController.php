<?php

namespace App\Http\Controllers;

use App\Article;
use App\Heading;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $articles = Article::where('is_approved', 1)->paginate(10);
        $headings = Heading::all();
        if (auth()->user() !== null) {
            if ((auth()->user()->getRole() == 'admin')) {
                return view('admin.index_admin', compact('articles', 'headings'));
            } elseif (auth()->user()->getRole() == 'moderator') {
                return view('moderator.index_moderator', compact('articles', 'headings'));
            }
        }
        return view('index', compact('articles', 'headings'));
    }

    public function search($heading) {
        $articles = Article::with('headings')->whereHas('headings', function($query) use ($heading){
            $query->where('headings.id', $heading);
        })->paginate(10);
        $headings = Heading::all();

        if (auth()->user() !== null) {
            if ((auth()->user()->getRole() == 'admin')) {
                return view('admin.index_admin', compact('articles', 'headings'));
            } elseif (auth()->user()->getRole() == 'moderator') {
                return view('moderator.index_moderator', compact('articles', 'headings'));
            }
        }
        return view('index', compact('articles', 'headings'));
    }
}
