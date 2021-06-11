<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Heading;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function heading(Request $request) {
        Heading::create($request->all());
        return redirect()->back();
    }

    public function not_approved() {
        $articles = Article::where('is_approved', 0)->get();
        return view('admin.approve_article', compact('articles'));
    }

    public function show($id) {
        $article = Article::where('id', $id)->firstOrFail();
        return view('admin.article', compact('article'));
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
