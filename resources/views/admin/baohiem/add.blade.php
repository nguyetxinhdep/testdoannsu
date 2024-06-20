@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addBaoHiem">
            @csrf
            <div class="form-group">
                <label for="TenBaoHiem">Tên bảo hiểm</label>
                <input type="text" class="form-control" id="TenBaoHiem" name="TenBaoHiem" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Bảo hiểm</button>
        </form>
    </div>
    <script>
        document.getElementById('addBaoHiem').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/insurance/add', {
                TenBaoHiem: formData.get('TenBaoHiem'),
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

