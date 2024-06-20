@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addLoaiHopDong">
            @csrf
            <div class="form-group">
                <label for="TenLoaiHopDong">Tên loại hợp đồng</label>
                <input type="text" value="{{$hopdong->TenLoaiHopDong}}" class="form-control" id="TenLoaiHopDong" name="TenLoaiHopDong" required>
            </div>
            <div class="form-group">
                <label for="ThoiHanHopDong">Thời hạn hợp đồng</label>
                <input type="text" value="{{$hopdong->ThoiHanHopDong}}" class="form-control" id="ThoiHanHopDong" name="ThoiHanHopDong" required>
            </div>

            <button type="submit" class="btn btn-primary">Sửa Loại hợp đồng</button>
        </form>
    </div>
    <script>
        document.getElementById('addLoaiHopDong').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/contract-type/edit', {
                id: {{$hopdong->MaLoaiHopDong}},
                TenLoaiHopDong: formData.get('TenLoaiHopDong'),
                ThoiHanHopDong: formData.get('ThoiHanHopDong'),
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

