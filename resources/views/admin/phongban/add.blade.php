@extends('main')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">    
                    <div class="card-body">

                        <form id="addPhongBan">
                            @csrf
    
                            <div class="form-group row">
                                <label for="TenPhongBan" class="col-md-4 col-form-label text-md-right">Tên Phòng Ban</label>
    
                                <div class="col-md-6">
                                    <input id="MaNV" type="text" class="form-control" name="TenPhongBan" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="DienThoaiPhongBan" class="col-md-4 col-form-label text-md-right">Số điện thoại phòng ban</label>
    
                                <div class="col-md-6">
                                    <input id="SoGio" type="text" class="form-control " name="DienThoaiPhongBan" required>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm mới
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('addPhongBan').addEventListener('submit', function(event) {
            event.preventDefault();
    
            const formData = new FormData(this);
            axios.post('/admin/department/add', {
                TenPhongBan: formData.get('TenPhongBan'),
                DienThoaiPhongBan: formData.get('DienThoaiPhongBan'),
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
