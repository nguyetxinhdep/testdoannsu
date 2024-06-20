@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addQuyetDinhTD">
            @csrf
            <div class="form-group">
                <label for="NgayQuyetDinhKhenThuong_KyLuat">Ngày quyết định:</label>
                <input type="date" value="@php echo date('2024-m-d'); @endphp" class="form-control" id="NgayQuyetDinhKhenThuong_KyLuat" name="NgayQuyetDinhKhenThuong_KyLuat" required>
            </div>
            <div class="form-group">
                <label for="NoiDungQuyetDinhKhenThuong_KyLuat">Nội dung</label>
                <input type="text" class="form-control" id="NoiDungQuyetDinhKhenThuong_KyLuat" name="NoiDungQuyetDinhKhenThuong_KyLuat" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Quyết định</button>
        </form>
    </div>
    <script>
        document.getElementById('addQuyetDinhTD').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/reward-discipline/decide/add', {
                NgayQuyetDinhKhenThuong_KyLuat: formData.get('NgayQuyetDinhKhenThuong_KyLuat'),
                NoiDungQuyetDinhKhenThuong_KyLuat: formData.get('NoiDungQuyetDinhKhenThuong_KyLuat'),
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

