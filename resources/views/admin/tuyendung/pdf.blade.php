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
    <h1>Danh sách Quyết định tuyển dụng</h1>
    <table>
        <thead>
            <tr>	
                <th>Số quyết định TD</th>
                <th>Ngày quyết định</th>
                <th>Thời gian thử việc</th>
                <th>Mức lương thử việc</th>
                <th>Nơi dùng quyết định</th>
                <th>Mã nhân viên</th>
                <th>Mã phòng ban</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tuyendungs as $tuyendung)
                <tr>
                    <td>{{ $tuyendung->SoQuyetDinhTuyenDung }}</td>
                    <td>{{ $tuyendung->NgayQuyetDinhTuyenDung }}</td>
                    <td>{{ $tuyendung->ThoiGianThuViec }}</td>
                    <td>{{ $tuyendung->MucLuongThuViec }}</td>
                    <td>{{ $tuyendung->NoiDungQuyetDInhTuyenDung }}</td>
                    <td>{{ $tuyendung->MaNV }}</td>
                    <td>{{ $tuyendung->MaPhongBan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
