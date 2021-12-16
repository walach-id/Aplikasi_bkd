<html>
    <head>
        <title>
Laporan Pengajaran
        </title>
    </head>
    <body>
        <h1>IDENTITAS</h1>
        
        <br>
        <hr>
        <table border="1" width="100%">
            <tr>
                <th>NIK</th>
                <th>Nama Dosen</th>
                <th>SKS</th>
            </tr>
            @foreach ($pengajaran as $data)
            <tr>
                <td>{{ $data->nik }}</td>
                <td>{{ $data->nama_dosen }}</td>
                <td>{{ $data->sum }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>