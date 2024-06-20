@extends('main')

@section('content')
    <div class="container py-3">
        <form id="suaqdl">
            @csrf
            <div class="form-group">
                <label for="MaNV">Mã nhân viên</label>
                <input type="number" value="{{$qdl->MaNV}}" class="form-control" id="MaNV" name="MaNV" required>
            </div>
            <div class="form-group">
                <label for="MucLuongCoBan">Mức lương cơ bản</label>
                <input type="number" value="{{$qdl->MucLuongCoBan}}" class="form-control" id="MucLuongCoBan" name="MucLuongCoBan" required>
            </div>
            <div class="form-group">
                <label for="NgayQuyetDinhLuong">Ngày quyết định lương</label>
                <input type="date" value="{{$qdl->NgayQuyetDinhLuong}}" class="form-control" id="NgayQuyetDinhLuong" name="NgayQuyetDinhLuong" required>
            </div>

            <button type="submit" class="btn btn-primary">Sửa quyết định lương</button>
        </form>
    </div>
    <script>
        document.getElementById('suaqdl').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/salary-decision/edit', {
                id:{{$qdl->SoQuyetDinhLuong}},
                MaNV: formData.get('MaNV'),
                MucLuongCoBan: formData.get('MucLuongCoBan'),
                NgayQuyetDinhLuong: formData.get('NgayQuyetDinhLuong'),
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

