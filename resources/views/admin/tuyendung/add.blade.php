@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addQuyetDinhTD">
            @csrf
            <div class="form-group">
                <label for="NgayQuyetDinhTuyenDung">Ngày quyết định:</label>
                <input type="date" value="@php echo date('2024-m-d'); @endphp" class="form-control" id="NgayQuyetDinhTuyenDung" name="NgayQuyetDinhTuyenDung" required>
            </div>
            <div class="form-group">
                <label for="ThoiGianThuViec">Thời gian thử việc</label>
                <input type="text" class="form-control" id="ThoiGianThuViec" placeholder="Ví dụ: 3 tháng" name="ThoiGianThuViec" required>
            </div>
            <div class="form-group">
                <label for="MucLuongThuViec">Mức lương thử việc</label>
                <input type="number" class="form-control" id="MucLuongThuViec"  name="MucLuongThuViec" required>
            </div>
            <div class="form-group">
                <label for="NoiDungQuyetDInhTuyenDung">Nơi dùng quyết định tuyển dụng</label>
                <input type="text" class="form-control" id="NoiDungQuyetDInhTuyenDung"  name="NoiDungQuyetDInhTuyenDung" required>
            </div>
            <div class="form-group">
                <label for="MaNV">Mã nhân viên</label>
                <input type="number" class="form-control" id="MaNV"  name="MaNV" required>
            </div>
            <div class="form-group">
                <label for="MaPhongBan">Mã Phòng ban</label>
                <input type="number" class="form-control" id="MaPhongBan"  name="MaPhongBan" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Quyết định</button>
        </form>
    </div>
    <script>
        document.getElementById('addQuyetDinhTD').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/hiring/add', {
                NgayQuyetDinhTuyenDung: formData.get('NgayQuyetDinhTuyenDung'),
                ThoiGianThuViec: formData.get('ThoiGianThuViec'),
                MucLuongThuViec: formData.get('MucLuongThuViec'),
                NoiDungQuyetDInhTuyenDung: formData.get('NoiDungQuyetDInhTuyenDung'),
                MaNV: formData.get('MaNV'),
                MaPhongBan: formData.get('MaPhongBan')
            })
            .then(response => {
                console.log(response.data);
                showResponseMessage('success', response.data.message);

                // Làm mới trang sau 5 giây
                setTimeout(function() {
                    const redirectUrl = response.data.url;
                    window.location.href = redirectUrl;
                    
                }, 5000);
            })
            .catch(error => {
                const message = error.response ? error.response.data.message : 'Đã có lỗi xảy ra khi thêm chi tiết';
                showResponseMessage('error', message);
            });
        });
    </script>
@endsection

