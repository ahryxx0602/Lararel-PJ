<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        //Sử dụng Session để check Login

    }
    //
    public function index()
    {
        return "<h2>Dashboard Welcome</h2>";
    }
}
