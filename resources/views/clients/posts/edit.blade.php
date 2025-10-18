@extends('clients.layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.</div>
    @endif

    <form action="{{ route('posts.post-edit', ['id' => $post->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề..."
                value="{{ old('title') ?? $post->title }}">
            @error('title')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Content</label>
            <input type="text" class="form-control" name="content" placeholder="Nội dung..."
                value="{{ old('content') ?? $post->content }}">
            @error('content')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" {{ (old('status') ?? $post->status) == 0 ? 'selected' : '' }}>Chưa kích hoạt
                </option>
                <option value="1" {{ (old('status') ?? $post->status) == 1 ? 'selected' : '' }}>Kích hoạt
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
@endsection
