@extends('clients.layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif

    <h4 class="mb-4">Chi tiết người dùng</h4>

    <div class="mb-3">
        <label for="">Họ và tên</label>
        <input type="text" class="form-control" value="{{ $userDetail->fullName }}" readonly>
    </div>

    <div class="mb-3">
        <label for="">Email</label>
        <input type="email" class="form-control" value="{{ $userDetail->email }}" readonly>
    </div>

    <div class="mb-3">
        <label for="">Nhóm</label>
        <input type="text" class="form-control" value="{{ $userDetail->group_name ?? 'Không xác định' }}" readonly>
    </div>

    <div class="mb-3">
        <label for="">Trạng thái</label>
        @php
            $statusLabel = $userDetail->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt';
        @endphp
        <input type="text" class="form-control" value="{{ $statusLabel }}" readonly>
    </div>

    <div class="mb-3">
        <label for="">Ngày tạo</label>
        <input type="text" class="form-control" value="{{ $userDetail->created_at }}" readonly>
    </div>

    <div class="mb-3">
        <label for="">Cập nhật lần cuối</label>
        <input type="text" class="form-control" value="{{ $userDetail->updated_at }}" readonly>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
@endsection
