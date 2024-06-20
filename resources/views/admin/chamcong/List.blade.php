@extends('main')

@section('content')
<div class="container py-3">
    {{-- <div class="mb-3">
        <a href="/admin/position-decision/add" class="btn btn-success">Thêm mới</a>
    </div> --}}
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
                    <th>Mã nhân viên</th>
                    <th>Giờ vào</th>
                    <th>Giờ ra</th>
                    <th>Ngày chấm công</th>
                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($ds);}} --}}
                @foreach ($chamcongs as $chamcong)
                    <tr>
                        <td>{{ $chamcong->MaNV }}</td>
                        <td>{{ $chamcong->Checkin }}</td>
                        <td>{{ $chamcong->Checkout }}</td>
                        <td>{{ $chamcong->NgayChamCong }}</td>
                        {{-- <td style="text-align:center">
                            <a class="btn btn-primary btn-sm" href="/admin/position-decision/edit/{{$chamcong->SoQuyetDinhChucVu}}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/position-decision/delete/{{$chamcong->SoQuyetDinhChucVu}}')"><i class="fas fa-trash-alt"></i></a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <a class="btn btn-success" href="/admin/reward-discipline/individual/List/export">Xuất Excel</a>
        <a class="btn btn-danger" href="/admin/reward-discipline/individual/List/export-pdf">Xuất PDF</a> --}}
    @endif
</div>
@endsection