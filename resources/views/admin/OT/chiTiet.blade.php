@extends('main')

@section('content')
    <div class="container py-3">
        <div class="mb-3">
            <a href="/admin/OT/chitiet/add" class="btn btn-success">Thêm mới</a>
        </div>

        <h1>{{ $title }}</h1>
        @if(isset($message))
            <div class="alert alert-info">{{ $message }}</div>
        @else
            <table class="table table-bordered" style="text-align:center">
                <thead>
                    <th>Mã chi tiết</th>
                    <th>Mã nhân viên</th>
                    <th>Mã số phiếu</th>
                    <th>Số giờ</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($chitiets as $chitiet)
                        <tr>
                            <td>{{$chitiet->MaChiTiet}}</td>
                            <td>{{$chitiet->MaNV}}</td>
                            <td>{{$chitiet->SoPhieu}}</td>
                            <td>{{$chitiet->SoGio}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="chitiet/edit/{{$chitiet->MaChiTiet}}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/OT/chitiet/delete/{{$chitiet->MaChiTiet}}')"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
