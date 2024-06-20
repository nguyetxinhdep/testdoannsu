@extends('main')

@section('content')
<div class="container py-3">
    <div class="mb-3">
        <a href="/admin/insurance-book/add" class="btn btn-success">Thêm mới</a>
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
                    <th>Mã sổ bảo hiểm</th>
                    <th>Mã nhân viên</th>
                    <th>Ngày lập sổ bảo hiểm</th>
                    <th>Thời hạn sổ bảo hiểm</th>
                    <th>Mã bảo hiểm</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($ds);}} --}}
                @foreach ($sobaohiems as $sobaohiem)
                    <tr>
                        <td>{{ $sobaohiem->MaSoBaoHiem }}</td>
                        <td>{{ $sobaohiem->MaNV }}</td>
                        <td>{{ $sobaohiem->NgayLapSoBaoHiem }}</td>
                        <td>{{ $sobaohiem->ThoiHanSoBaoHiem }}</td>
                        <td>{{ $sobaohiem->MaBaoHiem }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/insurance-book/edit/{{$sobaohiem->MaSoBaoHiem}}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/insurance-book/delete/{{$sobaohiem->MaSoBaoHiem}}')"><i class="fas fa-trash-alt"></i></a>
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