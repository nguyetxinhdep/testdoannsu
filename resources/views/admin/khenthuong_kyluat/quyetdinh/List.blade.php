@extends('main')

@section('content')
<div class="container py-3">
    <div class="mb-3">
        <a href="/admin/reward-discipline/decide/add" class="btn btn-success">Thêm mới</a>
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
                    <th>SQD khen thưởng/Kỷ luật</th>
                    <th>Ngày quyết định</th>
                    <th>Nội dung</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($ds);}} --}}
                @foreach ($ds as $kthuong_kluat)
                    <tr>
                        <td>{{ $kthuong_kluat->SoQuyetDinhKhenThuong_KyLuat }}</td>
                        <td>{{ $kthuong_kluat->NgayQuyetDinhKhenThuong_KyLuat }}</td>
                        <td>{{ $kthuong_kluat->NoiDungQuyetDinhKhenThuong_KyLuat }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/reward-discipline/decide/edit/{{$kthuong_kluat->SoQuyetDinhKhenThuong_KyLuat}}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/reward-discipline/decide/delete/{{$kthuong_kluat->SoQuyetDinhKhenThuong_KyLuat}}')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-success" href="/admin/reward-discipline/decide/List/export">Xuất Excel</a>
        <a class="btn btn-danger" href="/admin/reward-discipline/decide/List/export-pdf">Xuất PDF</a>
    @endif
</div>
@endsection