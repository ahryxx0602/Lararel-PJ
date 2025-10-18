@extends('clients.layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-{{ session('msg_type', 'info') }}">{{ session('msg') }}</div>
    @endif
    <h1 class="">{{ $title }}</h1>
    <hr />
    <form action="{{ route('posts.delete-multiple') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')"
        class="mb-3">
        @csrf
        <a href="{{ route('posts.add') }}" class="btn btn-primary mb-3">Thêm bài viết</a>
        <button type="submit" id="delete-selected" class="btn btn-danger mb-3">Xóa mục đã chọn</button>
        <table class="table table-striped-columns table-bordered table-hover ">
            <thead>
                <tr>
                    <th width="5%">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th>STT</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Trạng thái</th>
                    <th colspan="2" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ListPosts as $key => $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="delete[]" value="{{ $item->id }}">
                        </td>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('posts.edit', ['id' => $item->id]) }}">{{ $item->title }}</a></td>
                        <td>{{ $item->content }}</td>
                        <td>
                            @if ($item->trashed())
                                <label class="btn btn-danger btn-sm">Đã xóa</label>
                            @else
                                <label class="btn btn-success btn-sm">Đang hoạt động</label>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($item->trashed())
                                <a href="{{ route('posts.restore', $item) }}" class="btn btn-success btn-sm btn-action">
                                    <i class="bi bi-pencil-square"></i> Khôi phục
                                </a>
                                <a href="{{ route('posts.force-delete', ['id' => $item->id]) }}"
                                    onclick="return confirm('Are u sure')" class="btn btn-danger btn-sm btn-action">
                                    <i class="bi bi-pencil-square"></i> Xóa vĩnh viễn
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-3">Không có bài viết</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </form>
@endsection

@section('css')
@endsection
@section('js')
@endsection
