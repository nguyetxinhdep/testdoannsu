@extends('main')

@section('content')
    <div class="container py-3">
        <form id="suathongtin">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ Auth::user()->email }}" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn btn-primary">Sửa Thông tin</button>
            <a href="/profile/editpass" type="submit" class="btn btn-warning">Đổi mật khẩu</a>
        </form>
    </div>
    <script>
        document.getElementById('suathongtin').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/profile/edit', {
                name: formData.get('name'),
                email: formData.get('email'),
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

