@extends('main')

@section('content')
<div class="container py-3">
    <form id="updateEmployeeForm">
        @csrf
        {{-- @method('PUT') --}}

        <input type="hidden" class="form-control" id="MaNV" name="MaNV" value="{{ $nhanvien->MaNV }}">
        <div class="form-group">
            <label for="TenNV">Tên nhân viên:</label>
            <input type="text" class="form-control" id="TenNV" name="TenNV" value="{{ $nhanvien->TenNV }}">
        </div>
        <div class="form-group">
            <label for="NgaySinh">Ngày sinh:</label>
            <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="{{ $nhanvien->NgaySinh }}">
        </div>
        <div class="form-group">
            <label for="GioiTinh">Giới tính:</label>
            <select class="form-control" id="GioiTinh" name="GioiTinh">
                <option value="Nam" {{ $nhanvien->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $nhanvien->GioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="NgaySinh">Địa chỉ</label>
            <input type="text" class="form-control" id="NgaySinh" name="DiaChiNV" value="{{ $nhanvien->DiaChiNV }}">
        </div>
        <div class="form-group">
            <label for="NgaySinh">Số điện thoại:</label>
            <input type="text" class="form-control" id="NgaySinh" name="DienThoaiNV" value="{{ $nhanvien->DienThoaiNV }}">
        </div>
        <!-- Thêm các trường dữ liệu khác tương tự -->
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="/admin/employ/List" class="btn btn-warning">
            quay lại
        </a>
    </form>
</div>
<script>
    document.getElementById('updateEmployeeForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        axios.post('/admin/employ/edit', {
            MaNV: formData.get('MaNV'),
            TenNV: formData.get('TenNV'),
            NgaySinh: formData.get('NgaySinh'),
            GioiTinh: formData.get('GioiTinh'),
            DiaChiNV: formData.get('DiaChiNV'),
            DienThoaiNV: formData.get('DienThoaiNV')
        })
        .then(response => {
            console.log(response.data);
            alert('Nhân viên đã được sửa thành công!');
        })
        .catch(error => {
            console.error(error);
            alert('Đã có lỗi xảy ra khi sửa nhân viên.');
        });
    });
</script>
@endsection
