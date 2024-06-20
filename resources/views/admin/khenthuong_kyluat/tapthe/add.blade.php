@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addKTKLTT">
            @csrf
            <div class="form-group">
                <label for="SoQuyetDinhKhenThuong_KyLuat">SQĐ Khen thưởng | Kỷ luật</label>
                <input type="number" value="" class="form-control" id="SoQuyetDinhKhenThuong_KyLuat" name="SoQuyetDinhKhenThuong_KyLuat" required>
            </div>
            <div class="form-group">
                <label for="MaPhongBan">Mã Phòng Ban</label>
                <input type="number" class="form-control" id="MaPhongBan" name="MaPhongBan" required>
            </div>

            <div class="form-group">
                <label for="SoTienKhenThuong_KyLuatTapThe">Số tiền</label>
                <input type="number" class="form-control" id="SoTienKhenThuong_KyLuatTapThe" name="SoTienKhenThuong_KyLuatTapThe" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Khen thưởng</button>
        </form>
    </div>
    <script>
        document.getElementById('addKTKLTT').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/reward-discipline/collective/add', {
                SoQuyetDinhKhenThuong_KyLuat: formData.get('SoQuyetDinhKhenThuong_KyLuat'),
                MaPhongBan: formData.get('MaPhongBan'),
                SoTienKhenThuong_KyLuatTapThe: formData.get('SoTienKhenThuong_KyLuatTapThe'),
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

