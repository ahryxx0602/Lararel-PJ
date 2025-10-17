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

    <form action="{{ route('users.post-add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control" name="fullName" placeholder="Nhập họ và tên..."
                value="{{ old('fullName') }}">
            @error('fullName')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Nhập email..."
                value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Mật khẩu</label>
            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu...">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Nhóm</label>
            <select name="group_id" class="form-control">
                <option value="0">-- Chọn nhóm --</option>
                @if (!empty($allGroups))
                    @foreach ($allGroups as $item)
                        <option value="{{ $item->id }}" {{ old('group_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Chưa kích hoạt</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Kích hoạt</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Thêm người dùng</button>
    </form>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
@endsection
