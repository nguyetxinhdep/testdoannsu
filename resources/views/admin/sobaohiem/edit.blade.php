@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addLoaiHopDong">
            @csrf
            <div class="form-group">
                <label for="MaSoBaoHiem">Mã sổ bảo hiểm</label>
                <input type="number" value="{{$sobaohiem->MaSoBaoHiem}}" class="form-control" id="MaSoBaoHiem" name="MaSoBaoHiem" required>
            </div>
            <div class="form-group">
                <label for="MaNV">Mã nhân viên</label>
                <input type="number" value="{{$sobaohiem->MaNV}}" class="form-control" id="MaNV" name="MaNV" required>
            </div>
            <div class="form-group">
                <label for="NgayLapSoBaoHiem">Ngày lập Sổ bảo hiểm</label>
                <input type="date" value="{{$sobaohiem->NgayLapSoBaoHiem}}" class="form-control" id="NgayLapSoBaoHiem" name="NgayLapSoBaoHiem" required>
            </div>
            <div class="form-group">
                <label for="ThoiHanSoBaoHiem">Thời hạn sổ bảo hiểm</label>
                <input type="text" value="{{$sobaohiem->ThoiHanSoBaoHiem}}" class="form-control" id="ThoiHanSoBaoHiem" name="ThoiHanSoBaoHiem" required>
            </div>
            <div class="form-group">
                <label for="MaBaoHiem">Mã bảo hiểm</label>
                <input type="number" value="{{$sobaohiem->MaBaoHiem}}" class="form-control" id="MaBaoHiem" name="MaBaoHiem" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo sổ bảo hiểm</button>
        </form>
    </div>
    <script>
        document.getElementById('addLoaiHopDong').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/insurance-book/edit', {
                id: {{$sobaohiem->MaSoBaoHiem}},
                MaSoBaoHiem: formData.get('MaSoBaoHiem'),
                MaNV: formData.get('MaNV'),
                NgayLapSoBaoHiem: formData.get('NgayLapSoBaoHiem'),
                ThoiHanSoBaoHiem: formData.get('ThoiHanSoBaoHiem'),
                MaBaoHiem: formData.get('MaBaoHiem'),
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

