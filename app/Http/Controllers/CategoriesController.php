<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct(Request $request)
    {
        /*
        Nếu là trang danh sách chuyên mục => hiển thị xin chào unicode
        */
        if ($request->is('categories')) {
            echo "Xin chào Unicode";
        };
    }

    //Hiển thị danh sách chuyên mục
    public function index(Request $request)
    {
        // $allData = $request->all();
        // echo $request->all()['id'];
        // echo  dd($allData);
        return view("/clients/categories/list");
    }
    //Lấy ra 1 chuyên mục theo id [GET]
    public function getCategory($id)
    {
        return view("/clients/categories/edit");
    }
    // Cập nhật 1 chuyên mục [POST]
    public function updateCategory($id)
    {
        return "Submit sửa chuyên mục: " . $id;
    }
    //Show form thêm dữ liệu [GET]
    public function addCategory(Request $request)
    {
        $path = $request->path();
        echo $path;
        return view("/clients/categories/add");
    }
    //Thêm 1 chuyên mục [POST]
    public function handleAddCategory(Request $request)
    {
        $allData = $request->all();
        echo  dd($allData);
        return redirect(route("categories.add"));
        // return "Submit thêm chuyên mục";
    }
    //Xóa chuyên mục
    public function deleteCategory($id)
    {
        return "Submit xóa chuyên mục";
    }
}
