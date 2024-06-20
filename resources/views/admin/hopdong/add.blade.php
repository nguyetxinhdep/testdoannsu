@extends('main')

@section('content')
    <div class="container py-3">
        <form id="addLoaiHopDong">
            @csrf
            <div class="form-group">
                <label for="MaLoaiHopDong">Mã loại hợp đồng</label>
                <input type="number" value="" class="form-control" id="MaLoaiHopDong" name="MaLoaiHopDong" required>
            </div>
            <div class="form-group">
                <label for="MaNV">Mã nhân viên</label>
                <input type="number" value="" class="form-control" id="MaNV" name="MaNV" required>
            </div>
            <div class="form-group">
                <label for="NgayLapHopDong">Ngày lập hợp đồng</label>
                <input type="date" value="@php echo date('2024-m-d'); @endphp" class="form-control" id="NgayLapHopDong" name="NgayLapHopDong" required>
            </div>
            <div class="form-group">
                <label for="NoiDungHopDong">Nội dung hợp đồng</label>
                <input type="text" class="form-control" id="NoiDungHopDong" name="NoiDungHopDong" required>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Loại hợp đồng</button>
        </form>
    </div>
    <script>
        document.getElementById('addLoaiHopDong').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/contract/add', {
                MaLoaiHopDong: formData.get('MaLoaiHopDong'),
                MaNV: formData.get('MaNV'),
                NgayLapHopDong: formData.get('NgayLapHopDong'),
                NoiDungHopDong: formData.get('NoiDungHopDong'),
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

