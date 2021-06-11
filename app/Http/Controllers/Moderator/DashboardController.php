<?php

namespace App\Http\Controllers\Moderator;

use App\Article;
use App\Heading;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function not_approved() {
        $articles = Article::where('is_approved', 0)->get();
        $headings = Heading::all();
        return view('moderator.approve_article', compact('articles', 'headings'));
    }

    public function show($id) {
        $article = Article::where('id', $id)->firstOrFail();
        return view('moderator.article', compact('article'));
    }

    public function moderate($id) {
        if (\request()->has('approve')) {
            Article::where('id', $id)->update(['is_approved' => 1]);
        }
        else {
            Article::where('id', $id)->delete();
        }
        return $this->not_approved();
    }
}
