@extends('main')

@section('content')
    <div class="container py-3">
        <form id="suaKhenThuongCaNhan">
            @csrf
            <div class="form-group">
                <label for="SoQuyetDinhKhenThuong_KyLuat">SQĐ Khen thưởng | Kỷ luật</label>
                <input type="number" value="{{$ktklcn->SoQuyetDinhKhenThuong_KyLuat}}" class="form-control" id="SoQuyetDinhKhenThuong_KyLuat" name="SoQuyetDinhKhenThuong_KyLuat" required>
            </div>
            <div class="form-group">
                <label for="MaNV">Mã nhân viên</label>
                <input type="number" value="{{$ktklcn->MaNV}}" class="form-control" id="MaNV" name="MaNV" required>
            </div>

            <div class="form-group">
                <label for="SoTienKhenThuong_KyLuatCaNhan">Số tiền</label>
                <input type="number" value="{{$ktklcn->SoTienKhenThuong_KyLuatCaNhan}}" class="form-control" id="SoTienKhenThuong_KyLuatCaNhan" name="SoTienKhenThuong_KyLuatCaNhan" required>
            </div>

            <button type="submit" class="btn btn-primary">Sửa Khen thưởng</button>
        </form>
    </div>
    <script>
        document.getElementById('suaKhenThuongCaNhan').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/reward-discipline/individual/edit', {
                SoQuyetDinhKhenThuong_KyLuat: formData.get('SoQuyetDinhKhenThuong_KyLuat'),
                MaNV: formData.get('MaNV'),
                SoTienKhenThuong_KyLuatCaNhan: formData.get('SoTienKhenThuong_KyLuatCaNhan'),
                id: {{$ktklcn->id}}
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

