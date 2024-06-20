@section('head')
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;
            
            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
            
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
            }
    </style>
@endsection

@extends('main')

@section('content')
<section class="vh-100" style="background-color: #f4f5f7;">
    <div class="container py-3 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-6 mb-4 mb-lg-0">
          <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">
              <div class="col-md-12 gradient-custom text-center text-white"
                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <img src="{{Auth::user()->image}}"
                  alt="Avatar" class="img-fluid my-5" style="width: 100px;" />
                <h5>{{ Auth::user()->name }}</h5>
                {{-- <p>Web Designer</p> --}}
                <form  id="suathongtin" method="post" enctype="multipart/form-data" class="form-controll">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label"></label>
                        <input class="form-control" name ="img" type="file" id="formFile">
                    </div>
                    <button type="submit">Sửa</button>
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
        document.getElementById('suathongtin').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            axios.post('/profile/editimage', formData) // Gửi trực tiếp formData
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
                    const message = error.response ? error.response.data.message : 'Đã có lỗi xảy ra khi sửa ảnh';
                    showResponseMessage('error', message);
                });
        });

</script>
@endsection