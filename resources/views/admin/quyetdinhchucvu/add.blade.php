@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addqdcv">
            @csrf
            <div class="form-group">
                <label for="MaNV">Mã nhân viên</label>
                <input type="number" value="" class="form-control" id="MaNV" name="MaNV" required>
            </div>
            <div class="form-group">
                <label for="NgayQuyetDinhChucVu">Ngày quyết định chức vụ</label>
                <input type="date" value="@php echo date('2024-m-d'); @endphp" class="form-control" id="NgayQuyetDinhChucVu" name="NgayQuyetDinhChucVu" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo quyết định chức vụ</button>
        </form>
    </div>
    <script>
        document.getElementById('addqdcv').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/position-decision/add', {
                MaNV: formData.get('MaNV'),
                NgayQuyetDinhChucVu: formData.get('NgayQuyetDinhChucVu'),
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

