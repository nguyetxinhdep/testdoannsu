@extends('main')

@section('content')
<div class="container py-3">
    <h1>Danh sách Nhân Viên</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($nhanviens)}} --}}
            @foreach ($nhanviens as $nhanvien)
                <tr>
                    <td>{{ $nhanvien->MaNV }}</td>
                    <td>{{ $nhanvien->TenNV }}</td>
                    <td>{{ $nhanvien->NgaySinh }}</td>
                    <td>{{ $nhanvien->GioiTinh }}</td>
                    <td>{{ $nhanvien->DiaChiNV }}</td>
                    <td>{{ $nhanvien->DienThoaiNV }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/employ/edit/{{$nhanvien->MaNV}}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/employ/delete/{{$nhanvien->MaNV}}')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="/admin/employ/List/export">Xuất Excel</a>
    <a class="btn btn-danger" href="/admin/employ/List/export-pdf">Xuất PDF</a>
</div>
@endsection