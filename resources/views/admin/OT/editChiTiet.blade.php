@extends('main')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">    
                    <div class="card-body">

                        <form id="SuaChiTiet">
                            @csrf
    
                            <div class="form-group row">
                                <label for="MaNV" class="col-md-4 col-form-label text-md-right" >Mã nhân viên</label>
    
                                <div class="col-md-6">
                                    <input id="MaNV" type="number" class="form-control" value="{{$chitiet->MaNV}}" name="MaNV" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="SoPhieu" class="col-md-4 col-form-label text-md-right">Mã số phiếu</label>
    
                                <div class="col-md-6">
                                    <input id="SoPhieu" type="number" class="form-control" value="{{$chitiet->SoPhieu}}" name="SoPhieu" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="SoGio" class="col-md-4 col-form-label text-md-right">Số giờ</label>
    
                                <div class="col-md-6">
                                    <input id="SoGio" type="number" class="form-control " value="{{$chitiet->SoGio}}" name="SoGio" required>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Sửa
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
        document.getElementById('SuaChiTiet').addEventListener('submit', function(event) {
            event.preventDefault();
    
            const formData = new FormData(this);
            axios.post('/admin/OT/chitiet/edit', {
                MaChiTiet: {{$chitiet->MaChiTiet}},
                MaNV: formData.get('MaNV'),
                SoPhieu: formData.get('SoPhieu'),
                SoGio: formData.get('SoGio'),
            })
            .then(response => {
                console.log(response.data);
                showResponseMessage('success', response.data.message);
            })
            .catch(error => {
                const message = error.response ? error.response.data.message : 'Đã có lỗi xảy ra khi thêm chi tiết';
                showResponseMessage('error', message);
            });
        });
    </script>
@endsection
