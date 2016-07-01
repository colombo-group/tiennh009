<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use App\User;

use App\Post;

class PageController extends Controller
{   

    public function __construct()
    {
        $category = Category::all();
        $post = Post::orderBy('updated_at', 'DESC')->get();
        view()->share([
                'category' => $category,
                'post' => $post,
            ]);
    }

    public function getHome() 
    {   
        $topView = Post::orderBy('view', 'DESC')->get(); 
        return view('pages.home')->with([
                'topView' => $topView, 
            ]);
    }

    public function getCategory() 
    {
        return view('pages.category');
    }

    public function getDetail() 
    {
        return view('pages.detail');
    }
}
