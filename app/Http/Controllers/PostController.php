<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $title = "Danh sách bài viết";
        // $ListPosts = Post::all();
        $ListPosts = Post::withTrashed()->orderBy("deleted_at", "ASC")->get();
        return view('clients.posts.lists', compact('title', 'ListPosts'));
    }

    public function add()
    {
        $title = 'Thêm bài viết mới';
        return view('clients.posts.add', compact('title'));
    }

    public function postAdd(Request $request)
    {
        $dataInsert = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        Post::create($dataInsert);
        return redirect()->route('posts.index')->with('success', 'Thêm bài viết thành công');
    }
    public function edit(Request $request)
    {
        $title = "Chỉnh sửa bài viết";
        $post = Post::find($request->id);
        $request->session()->put('id', $post->id);
        return view('clients.posts.edit', compact('title', 'post'));
    }
    public function postEdit($id, Request $request)
    {
        $post = Post::find($id);
        $dataUpdate = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ];
        // $post->update($dataUpdate);
        Post::updateOrCreate([
            'id' => $id
        ], $dataUpdate);
    }

    public function delete($id)
    {
        // $post = Post::destroy($id);
        // dd($post);
        $idCollect = collect([3, 4]);
        $idCollect->each(function ($id) {
            Post::destroy($id);
        });
    }

    public function handleDeleteMultiple(Request $request)
    {
        $deleteArr = $request->input('delete');
        if (empty($deleteArr)) {
            return redirect()->route('posts.index')->with('msg', 'Vui lòng chọn mục cần xóa')->with('msg_type', 'warning');
        }
        $status = Post::destroy($deleteArr);
        if ($status) {
            return redirect()->route('posts.index')->with('msg', 'Xóa mục đã chọn thành công')->with('msg_type', 'success');
        } else {
            return redirect()->route('posts.index')->with('msg', 'Xóa mục đã chọn thất bại')->with('msg_type', 'danger');
        }
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        if (!empty($post) && $post->trashed()) {
            $post->restore();
            return redirect()->route('posts.index')->with('msg', 'Khôi phục bài viết thành công')->with('msg_type', 'success');
        } else {
            return redirect()->route('posts.index')->with('msg', 'Bài viết không tồn tại hoặc không cần khôi phục')->with('msg_type', 'warning');
        }
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->find($id);
        if (!empty($post) && $post->trashed()) {
            $post->forceDelete();
            return redirect()->route('posts.index')->with('msg', 'Xóa vĩnh viễn bài viết thành công')->with('msg_type', 'success');
        } else {
            return redirect()->route('posts.index')->with('msg', 'Bài viết không tồn tại hoặc không thể xóa vĩnh viễn')->with('msg_type', 'warning');
        }
    }
}
