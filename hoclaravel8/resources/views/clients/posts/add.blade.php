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

    <form action="{{ route('posts.post-add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">
                Title
            </label>
            <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề..." value="{{ old('title') }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Content</label>
            <input type="text" class="form-control" name="content" placeholder="Nhập nội dung..."
                value="{{ old('content') }}">
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Status</label>
            <select name="status" class="form-control">
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Chưa kích hoạt</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Kích hoạt</option>
            </select>
        </div>
        @error('group_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <button type="submit" class="btn btn-success">Thêm bài viết</button>
    </form>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
@endsection
