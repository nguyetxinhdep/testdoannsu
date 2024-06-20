<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-family: DejaVu Sans, serif
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Danh sách Nhân Viên</h1>
    <table>
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Địa chỉ</th>
                <th>Điện thoại</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nhanViens as $nhanVien)
                <tr>
                    <td>{{ $nhanVien->MaNV }}</td>
                    <td>{{ $nhanVien->TenNV }}</td>
                    <td>{{ $nhanVien->NgaySinh }}</td>
                    <td>{{ $nhanVien->GioiTinh }}</td>
                    <td>{{ $nhanVien->DiaChiNV }}</td>
                    <td>{{ $nhanVien->DienThoaiNV }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
