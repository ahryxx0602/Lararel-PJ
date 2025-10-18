<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // $title = 'Danh sách bài viết';
        // $allPosts = Post::all();
        // dd($allPosts);
        $post = Post::find(1);
        dd($post);
        // return view('posts.index', compact('title', 'allPosts'));

        $post = new Post();
        $post->title = "Bài viết 3";
        $post->content = "Nội dung 3";
        $post->status = 1;
        $post->save();
    }
}
