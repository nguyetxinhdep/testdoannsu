@extends('main')

@section('content')
<div class="container py-3">
    <p>
        <form id="formsearchnv">
            @csrf
            <div class="input-group">
                <div class="form-outline">
                    <input type="text" name="employeeName" id="employeeName" class="form-control" placeholder="Nhập tên nhân viên" />
                </div>
                <button id="btnsearchnv" type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </p>

    {{-- Kết quả tìm kiếm --}}
    <div id="searchResult" style="display: none;" class="mb-3">
        <h2>Kết quả tìm kiếm: <span id="searchTerm"></span></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Tên NV</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                    <th>Địa Chỉ</th>
                    <th>Điện Thoại</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="searchResultBody">
                {{-- Dữ liệu sẽ được thêm bằng JavaScript --}}
            </tbody>
        </table>
        <button class="btn btn-danger" id="btnCloseSearchResult">Đóng</button>
    </div>
    
    <h1>Danh sách Nhân Viên</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($nhanviens)}} --}}
            @foreach ($nhanviens as $nhanvien)
                <tr>
                    <td>{{ $nhanvien->MaNV }}</td>
                    <td>{{ $nhanvien->TenNV }}</td>
                    <td>{{ $nhanvien->NgaySinh }}</td>
                    <td>{{ $nhanvien->GioiTinh }}</td>
                    <td>{{ $nhanvien->DiaChiNV }}</td>
                    <td>{{ $nhanvien->DienThoaiNV }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/employ/edit/{{$nhanvien->MaNV}}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/employ/delete/{{$nhanvien->MaNV}}')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="/admin/employ/List/export">Xuất Excel</a>
    <a class="btn btn-danger" href="/admin/employ/List/export-pdf">Xuất PDF</a>
</div>
<script>
    //JavaScript để gửi dữ liệu bằng Axios
    document.getElementById('formsearchnv').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        // test = formData.get('employeeName');
        // console.log(test);

        axios.get('/admin/employ/List/search', {
            // employeeName: formData.get('employeeName'),
            params: {
                employeeName: formData.get('employeeName'),
            }
        })
        .then(response => {
            console.log(response.data);
            const searchResult = document.getElementById('searchResult');
            const searchResultBody = document.getElementById('searchResultBody');
            const searchTerm = document.getElementById('searchTerm');

            // Xóa các dòng hiện tại trong bảng kết quả tìm kiếm
            searchResultBody.innerHTML = '';

            // Hiển thị kết quả tìm kiếm và thông tin tìm kiếm
            searchTerm.textContent = formData.get('employeeName');
            searchResult.style.display = 'block';

            // Thêm các dòng mới từ dữ liệu nhận được
            response.data.nhanvientim.forEach(nhanvien => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${nhanvien.MaNV}</td>
                    <td>${nhanvien.TenNV}</td>
                    <td>${nhanvien.NgaySinh}</td>
                    <td>${nhanvien.GioiTinh}</td>
                    <td>${nhanvien.DiaChiNV}</td>
                    <td>${nhanvien.DienThoaiNV}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/employ/edit/${nhanvien.MaNV}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('/admin/employ/delete/${nhanvien.MaNV}')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                `;
                searchResultBody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error(error);
        });
    });

    // JavaScript để đóng kết quả tìm kiếm
    document.getElementById('btnCloseSearchResult').addEventListener('click', function() {
        const searchResult = document.getElementById('searchResult');
        searchResult.style.display = 'none';
    });
</script>
@endsection