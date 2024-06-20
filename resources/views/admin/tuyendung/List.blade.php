@extends('main')

@section('content')
<div class="container py-3">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Số quyết định TD</th>
                <th>Ngày quyết định</th>
                <th>Thời gian thử việc</th>
                <th>Mức lương thử việc</th>
                <th>Nơi dùng quyết định</th>
                <th>Mã nhân viên</th>
                <th>Mã phòng ban</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($hirings)}} --}}
            @foreach ($hirings as $hiring)
                <tr>
                    <td>{{ $hiring->SoQuyetDinhTuyenDung }}</td>
                    <td>{{ $hiring->NgayQuyetDinhTuyenDung }}</td>
                    <td>{{ $hiring->ThoiGianThuViec }}</td>
                    <td>{{ $hiring->MucLuongThuViec }}</td>
                    <td>{{ $hiring->NoiDungQuyetDInhTuyenDung }}</td>
                    <td>{{ $hiring->MaNV }}</td>
                    <td>{{ $hiring->MaPhongBan }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/hiring/edit/{{$hiring->SoQuyetDinhTuyenDung}}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/hiring/delete/{{$hiring->SoQuyetDinhTuyenDung}}')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="/admin/hiring/List/export">Xuất Excel</a>
    <a class="btn btn-danger" href="/admin/hiring/List/export-pdf">Xuất PDF</a>
</div>
@endsection