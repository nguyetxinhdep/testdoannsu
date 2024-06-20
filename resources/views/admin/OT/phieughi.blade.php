@extends('main')

@section('content')
    <div class="container py-3">
        <div class="mb-3">
            <a href="/admin/OT/phieu/add" class="btn btn-success">Thêm mới</a>
        </div>

        <h1>{{ $title }}</h1>
        @if(isset($message))
            <div class="alert alert-info">{{ $message }}</div>
        @else
            <table class="table table-bordered" style="text-align:center">
                <thead>
                    <th>Số phiếu</th>
                    <th>Ngày Phụ trội</th>
                    <th>Hình thức</th>
                    <th>Hệ số</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($phieughi as $phieu)
                        <tr>
                            <td>{{$phieu->SoPhieu}}</td>
                            <td>{{$phieu->NgayPhuTroi}}</td>
                            <td>{{$phieu->HinhThucPhuTroi}}</td>
                            <td>{{$phieu->HeSoPhuTroi}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/admin/OT/edit/{{$phieu->SoPhieu}}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/OT/delete/{{$phieu->SoPhieu}}')"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
