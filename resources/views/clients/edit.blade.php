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

    <form action="{{ route('users.post-edit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control" name="fullName" placeholder="Họ và tên..."
                value="{{ old('fullName') ?? $userDetail->fullName }}">
            @error('fullName')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email..."
                value="{{ old('email') ?? $userDetail->email }}">
            @error('email')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Nhóm</label>
            <select name="group_id" class="form-control">
                <option value="0">Chọn nhóm</option>
                @if (!empty($allGroups))
                    @foreach ($allGroups as $item)
                        <option value="{{ $item->id }}"
                            {{ (old('group_id') ?? $userDetail->group_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" {{ (old('status') ?? $userDetail->status) == 0 ? 'selected' : '' }}>Chưa kích hoạt
                </option>
                <option value="1" {{ (old('status') ?? $userDetail->status) == 1 ? 'selected' : '' }}>Kích hoạt
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
@endsection
