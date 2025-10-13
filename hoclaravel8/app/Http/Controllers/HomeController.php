<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Action index()
    public function index()
    {
        return 'home';
    }
    public function getNews()
    {
        return "NEWS";
    }

    public function getCategory($id)
    {
        return "Category" . $id;
    }
}
