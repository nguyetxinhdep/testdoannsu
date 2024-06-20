@extends('main')

@section('content')
    <div class="container py-3">
        <form id="suathongtin">
            @csrf
            <div class="form-group">
                <label for="password">Nhập mật khẩu cũ</label>
                <input type="password" value="" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_new">Nhập mật khẩu mới</label>
                <input type="password" value="" class="form-control" id="password_new" name="password_new" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Nhập lại mật khẩu mới</label>
                <input type="password" value="" class="form-control" id="password_confirm" name="password_confirm" required>
            </div>

            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </form>
    </div>
    <script>
        document.getElementById('suathongtin').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/profile/editpass', {
                password: formData.get('password'),
                password_new: formData.get('password_new'),
                password_confirm: formData.get('password_confirm'),
            })
            .then(response => {
                console.log(response.data);
                showResponseMessage('success', response.data.message);

                // Làm mới trang sau 3 giây
                setTimeout(function() {
                    const redirectUrl = response.data.url;
                    window.location.href = redirectUrl;
                    
                }, 3000);
            })
            .catch(error => {
                const message = error.response ? error.response.data.message : 'Đã có lỗi xảy ra khi thêm chi tiết';
                showResponseMessage('error', message);
            });
        });
    </script>
@endsection

