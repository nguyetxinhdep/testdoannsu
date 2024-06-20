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
    <h1>Danh sách Quyết định khen thưởng kỷ luật</h1>
    <table>
        <thead>
            <tr>	
                <th>SQD khen thưởng | kỷ luật</th>
                <th>Ngày quyết định</th>
                <th>Nội dung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ktkls as $ktkl)
                <tr>
                    <td>{{ $ktkl->SoQuyetDinhKhenThuong_KyLuat }}</td>
                    <td>{{ $ktkl->NgayQuyetDinhKhenThuong_KyLuat }}</td>
                    <td>{{ $ktkl->NoiDungQuyetDinhKhenThuong_KyLuat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
