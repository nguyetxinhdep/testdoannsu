@extends('main')

@section('content')
<div class="container py-3">
    <div class="mb-3">
        <a href="/admin/reward-discipline/individual/add" class="btn btn-success">Thêm mới</a>
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
                    <th>Mã nhân viên</th>
                    <th>Số tiền khen thưởng kỷ luật</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($ds);}} --}}
                @foreach ($ds as $kthuong_kluat)
                    <tr>
                        <td>{{ $kthuong_kluat->SoQuyetDinhKhenThuong_KyLuat }}</td>
                        <td>{{ $kthuong_kluat->MaNV }}</td>
                        <td>{{ $kthuong_kluat->SoTienKhenThuong_KyLuatCaNhan }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/reward-discipline/individual/edit/{{$kthuong_kluat->id}}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/reward-discipline/individual/delete/{{$kthuong_kluat->id}}')"><i class="fas fa-trash-alt"></i></a>
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