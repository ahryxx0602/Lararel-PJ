<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Action index()
    public function index()
    {
        $title = "Học lập trình web Laravel";
        $content = "Nội dung học laravel";
        return view('home', compact('title', 'content'));
    }
    public function getNews()
    {
        return "NEWS";
    }

    public function getCategory($id)
    {
        return "Category" . $id;
    }
    public function getProductDetail($id)
    {
        return view('clients.products.detail', compact('id'));
    }
}
