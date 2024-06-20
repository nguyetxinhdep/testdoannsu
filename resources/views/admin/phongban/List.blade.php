@extends('main')

@section('content')
<div class="container py-3">
    <a class="btn btn-success" href="/admin/department/add">Thêm mới</a>

    <h1>Danh sách Phòng ban</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã phòng ban</th>
                <th>Tên phòng ban</th>
                <th>Điện thoại</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($phongbans)}} --}}
            @foreach ($phongbans as $phongban)
                <tr>
                    <td>{{ $phongban->MaPhongBan }}</td>
                    <td>{{ $phongban->TenPhongBan }}</td>
                    <td>{{ $phongban->DienThoaiPhongBan }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/department/edit/{{$phongban->MaPhongBan}}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/department/delete/{{$phongban->MaPhongBan}}')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection