@extends('main')

@section('content')
    <div class="container py-3">
        <form id="createEmployeeForm">
            @csrf
            <div class="form-group">
                <label for="TenNV">Tên nhân viên:</label>
                <input type="text" class="form-control" id="TenNV" name="TenNV" required>
            </div>
            <div class="form-group">
                <label for="NgaySinh">Ngày sinh:</label>
                <input type="date" value="@php echo date('2002-m-d'); @endphp" class="form-control" id="NgaySinh" name="NgaySinh" required>
            </div>
            <div class="form-group">
                <label for="GioiTinh">Giới tính:</label>
                <input type="text" class="form-control" id="GioiTinh" name="GioiTinh" required>
            </div>
            <div class="form-group">
                <label for="DiaChiNV">Địa chỉ:</label>
                <input type="text" class="form-control" id="DiaChiNV" name="DiaChiNV" required>
            </div>
            <div class="form-group">
                <label for="DienThoaiNV">Điện thoại:</label>
                <input type="text" class="form-control" id="DienThoaiNV" name="DienThoaiNV" required>
            </div>
            <button type="submit" class="btn btn-primary">Tạo Nhân Viên</button>
        </form>
    </div>
    <script>
        document.getElementById('createEmployeeForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/employ/add', {
                TenNV: formData.get('TenNV'),
                NgaySinh: formData.get('NgaySinh'),
                GioiTinh: formData.get('GioiTinh'),
                DiaChiNV: formData.get('DiaChiNV'),
                DienThoaiNV: formData.get('DienThoaiNV')
            })
            .then(response => {
                console.log(response.data);
                alert('Nhân viên đã được tạo thành công!');
            })
            .catch(error => {
                console.error(error);
                alert('Đã có lỗi xảy ra khi tạo nhân viên.');
            });
        });
    </script>
@endsection

