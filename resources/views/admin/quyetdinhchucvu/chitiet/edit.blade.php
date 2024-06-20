@extends('main')

@section('content')
    <div class="container py-3">
        <form id="suachitietchucvu">
            @csrf
            <div class="form-group">
                <label for="SoQuyetDinhChucVu">Số quyết định chức vụ</label>
                <input type="number" value="{{$ctcv->SoQuyetDinhChucVu}}" class="form-control" id="SoQuyetDinhChucVu" name="SoQuyetDinhChucVu" required>
            </div>
            <div class="form-group">
                <label for="MaChucVu">Mã Chức vụ</label>
                <input type="number" value="{{$ctcv->MaChucVu}}" class="form-control" id="MaChucVu" name="MaChucVu" required>
            </div>

            <button type="submit" class="btn btn-primary">Sửa Chi tiết chức vụ</button>
        </form>
    </div>
    <script>
        document.getElementById('suachitietchucvu').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/position-detail/edit', {
                id: {{$ctcv->id}},
                SoQuyetDinhChucVu: formData.get('SoQuyetDinhChucVu'),
                MaChucVu: formData.get('MaChucVu'),
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
                const message = error.response ? error.response.data.message : 'Đã có lỗi xảy ra khi sửa';
                showResponseMessage('error', message);
            });
        });
    </script>
@endsection

