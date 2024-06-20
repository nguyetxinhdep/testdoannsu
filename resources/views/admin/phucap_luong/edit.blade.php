@extends('main')

@section('content')
    <div class="container py-3">
        <form id="suapcl">
            @csrf
            <div class="form-group">
                <label for="SoQuyetDinhLuong">Số quyết định lương</label>
                <input type="number" value="{{$pcl->SoQuyetDinhLuong}}" class="form-control" id="SoQuyetDinhLuong" name="SoQuyetDinhLuong" required>
            </div>
            <div class="form-group">
                <label for="MaPhuCap">Mã phụ cấp</label>
                <input type="number" value="{{$pcl->MaPhuCap}}" class="form-control" id="MaPhuCap" name="MaPhuCap" required>
            </div>

            <button type="submit" class="btn btn-primary">Sửa Phụ cấp & Lương</button>
        </form>
    </div>
    <script>
        document.getElementById('suapcl').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/salary_allowance/edit', {
                id:{{$pcl->id}},
                SoQuyetDinhLuong: formData.get('SoQuyetDinhLuong'),
                MaPhuCap: formData.get('MaPhuCap'),
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

