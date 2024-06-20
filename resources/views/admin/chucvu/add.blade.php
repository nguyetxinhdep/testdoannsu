@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addchucvu">
            @csrf
            <div class="form-group">
                <label for="TenChucVu">Tên chức vụ</label>
                <input type="text" value="" class="form-control" id="TenChucVu" name="TenChucVu" required>
            </div>
            <div class="form-group">
                <label for="HeSoLuong">Hệ số lương</label>
                <input type="number" value="" class="form-control" id="HeSoLuong" name="HeSoLuong" required>
            </div>
            <div class="form-group">
                <label for="PhuCapChucVu">Phụ cấp chức vụ</label>
                <input type="number" value="" class="form-control" id="PhuCapChucVu" name="PhuCapChucVu" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Chức vụ</button>
        </form>
    </div>
    <script>
        document.getElementById('addchucvu').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/position/add', {
                TenChucVu: formData.get('TenChucVu'),
                HeSoLuong: formData.get('HeSoLuong'),
                PhuCapChucVu: formData.get('PhuCapChucVu'),
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
                const message = error.response ? error.response.data.message : 'Đã có lỗi xảy ra khi thêm';
                showResponseMessage('error', message);
            });
        });
    </script>
@endsection

