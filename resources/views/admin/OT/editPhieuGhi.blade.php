@extends('main')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">    
                    <div class="card-body">
                        <form id="editPhieuGhiPT">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="NgayPhuTroi" class="col-md-4 col-form-label text-md-right">Ngày Phụ Trợ</label>
    
                                <div class="col-md-6">
                                    <input id="NgayPhuTroi" value="{{$phieu->NgayPhuTroi}}" type="date" value="{{ now()->format('Y-m-d') }}" class="form-control @error('NgayPhuTroi') is-invalid @enderror" name="NgayPhuTroi" required autofocus>  

                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="HinhThucPhuTroi" class="col-md-4 col-form-label text-md-right">Hình Thức Phụ Trợ</label>
    
                                <div class="col-md-6">
                                    <input id="HinhThucPhuTroi" value="{{$phieu->HinhThucPhuTroi}}" type="text" class="form-control @error('HinhThucPhuTroi') is-invalid @enderror" name="HinhThucPhuTroi" required>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="HeSoPhuTroi" class="col-md-4 col-form-label text-md-right">Hệ Số Phụ Trợ</label>
    
                                <div class="col-md-6">
                                    <input id="HeSoPhuTroi" value="{{$phieu->HeSoPhuTroi}}" type="number" step="0.01" class="form-control @error('HeSoPhuTroi') is-invalid @enderror" name="HeSoPhuTroi" required>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Sửa
                                    </button>
                                    <a href="/admin/OT/phieu" class="btn btn-warning">
                                        quay lại
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('editPhieuGhiPT').addEventListener('submit', function(event) {
            event.preventDefault();
    
            const formData = new FormData(this);
            const data = {
                SoPhieu: {{ $phieu->SoPhieu }},
                NgayPhuTroi: formData.get('NgayPhuTroi'),
                HinhThucPhuTroi: formData.get('HinhThucPhuTroi'),
                HeSoPhuTroi: formData.get('HeSoPhuTroi')
            };

            axios.post('/admin/OT/edit', data)
                .then(response => {
                    console.log(response.data);
                    showResponseMessage('success', response.data.message);
                })
                .catch(error => {
                    console.error(error);
                    const message = error.response ? error.response.data.message : 'Đã có lỗi xảy ra khi sửa phiếu ghi.';
                    showResponseMessage('error', message);
                });
        });
    </script>
@endsection
