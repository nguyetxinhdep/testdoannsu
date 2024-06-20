@extends('main')

@section('content')
    <div class="container py-3">
        <form id="suaBaoHiem">
            @csrf
            <div class="form-group">
                <label for="TenBaoHiem">Tên bảo hiểm</label>
                <input type="text" value="{{$baohiem->TenBaoHiem}}" class="form-control" id="TenBaoHiem" name="TenBaoHiem" required>
            </div>

            <button type="submit" class="btn btn-primary">Sửa Bảo hiểm</button>
        </form>
    </div>
    <script>
        document.getElementById('suaBaoHiem').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/admin/insurance/edit', {
                id: {{$baohiem->MaBaoHiem}},
                TenBaoHiem: formData.get('TenBaoHiem'),
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

