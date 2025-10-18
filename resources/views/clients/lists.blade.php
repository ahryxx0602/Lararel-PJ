@extends('clients.layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1 class="">{{ $title }}</h1>
    <hr />
    <form action="" method="GET" class="mb-3">
        <div class="row">
            <div class="col-3">
                <label class="form-label">Tìm kiếm</label>
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm người dùng..."
                    value="{{ request()->get('keyword') }}">
            </div>
            <div class="col-3">
                <label class="form-label">Nhóm</label>
                <select name="group_id" class="form-control">
                    <option value="">-- Tất cả --</option>
                    @if (!empty(getAllGroups()))
                        @foreach (getAllGroups() as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="">-- Tất cả --</option>
                    <option value="inactive" {{ request('status') === '0' ? 'selected' : '' }}>Chưa kích hoạt</option>
                    <option value="active" {{ request('status') === '1' ? 'selected' : '' }}>Kích hoạt</option>
                </select>
            </div>
            <div class="col-3 d-flex align-items-end">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <a href="{{ route('users.add') }}" class="btn btn-primary mb-3">Thêm người dùng</a>
    <table class="table table-striped-columns table-bordered table-hover ">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th colspan="2" class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ListUsers as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="{{ route('users.detail', ['id' => $item->id]) }}">{{ $item->fullName }}</a></td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->group_name }}</td>
                    <td>
                        @if ($item->status == 0)
                            <span class="badge-status bg-danger text-white">Chưa kích hoạt</span>
                        @else
                            <span class="badge-status bg-success text-white">Kích hoạt</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td class="text-center">
                        <a href="{{ route('users.edit', ['id' => $item->id]) }}" class="btn btn-warning btn-sm btn-action">
                            <i class="bi bi-pencil-square"></i> Sửa
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('users.delete', ['id' => $item->id]) }}" class="btn btn-danger btn-sm btn-action"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
                            <i class="bi bi-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">Không có người dùng</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@section('css')
@endsection
@section('js')
@endsection
