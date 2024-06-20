@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addPhucap">
            @csrf
            <div class="form-group">
                <label for="TenPhuCap">Tên phụ cấp</label>
                <input type="text" value="" class="form-control" id="TenPhuCap" name="TenPhuCap" required>
            </div>
            <div class="form-group">
                <label for="SoTienPhuCap">Số tiền phụ cấp</label>
                <input type="number" value="" class="form-control" id="SoTienPhuCap" name="SoTienPhuCap" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Phụ cấp</button>
        </form>
    </div>
    <script>
        document.getElementById('addPhucap').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/allowance/add', {
                TenPhuCap: formData.get('TenPhuCap'),
                SoTienPhuCap: formData.get('SoTienPhuCap'),
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

