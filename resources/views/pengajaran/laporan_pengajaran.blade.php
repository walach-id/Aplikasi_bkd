<html>
    <head>
        <title>
Laporan Pengajaran
        </title>
    </head>
    <body>
        <h1>IDENTITAS</h1>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $dosen->nama }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $dosen->jenkel }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $dosen->nik }}</td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td>:</td>
                <td>{{ $dosen->npwp }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $dosen->tempat_lahir }}, {{ $dosen->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td>:</td>
                <td>{{ $dosen->kewarganegaraan }}</td>
            </tr>
        </table>
        <br>
        <hr>
        <table border="1" width="100%">
            <tr>
                <th>mata kuliah</th>
                <th>program studi</th>
                <th>SKS</th>
            </tr>
            @foreach ($pengajaran as $data)
            <tr>
                <td>{{ $data->matkul }}</td>
                <td>{{ $data->prodi }}</td>
                <td>{{ $data->sum }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>