
<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Lấy lại mật khẩu</p>
            {{-- thêm thông báo --}}
            @include('alert')
            {{-- {{dd($id);}} --}}
            <form action="{{route('doimatkhau',['id'=>$id->id])}}" method="post">
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <br>
                    <input type="password" name="confirm-password" class="form-control" placeholder="confirm-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <br>
                    {{-- @error('email')    
                        <small class="help-block" style="color:red">{{$message}}</small>
                    @enderror --}}
                    </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
                            </div>
                <!-- /.col -->
                        </div>

                @csrf
            </form>

    </div>
    <!-- /.login-box -->

    @include('footer')
</body>
</html>
