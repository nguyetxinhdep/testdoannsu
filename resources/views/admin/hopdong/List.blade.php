@extends('main')

@section('content')
<div class="container py-3">
    <div class="mb-3">
        <a href="/admin/contract/add" class="btn btn-success">Thêm mới</a>
    </div>
    {{-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
    @if(isset($message))
            <div class="alert alert-info">{{ $message }}</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Số hợp đồng</th>
                    <th>Mã loại hợp đồng</th>
                    <th>Mã nhân viên</th>
                    <th>Ngày lập hợp đồng</th>
                    <th>Nội dung hợp đồng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($ds);}} --}}
                @foreach ($hopdongs as $hopdong)
                    <tr>
                        <td>{{ $hopdong->SoHopDong }}</td>
                        <td>{{ $hopdong->MaLoaiHopDong }}</td>
                        <td>{{ $hopdong->MaNV }}</td>
                        <td>{{ $hopdong->NgayLapHopDong }}</td>
                        <td>{{ $hopdong->NoiDungHopDong }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/contract/edit/{{$hopdong->SoHopDong}}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/contract/delete/{{$hopdong->SoHopDong}}')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <a class="btn btn-success" href="/admin/reward-discipline/individual/List/export">Xuất Excel</a>
        <a class="btn btn-danger" href="/admin/reward-discipline/individual/List/export-pdf">Xuất PDF</a> --}}
    @endif
</div>
@endsection