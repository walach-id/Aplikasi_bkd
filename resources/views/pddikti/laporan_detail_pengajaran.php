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



    <div>

        <!-- DataTales Example -->
        <div>
            <div>
                <h6>Tabel Pengajaran Dosen</h6>
            </div>
            <div>
                <div>
                    <table width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Program Studi</th>
                                <th>Mata Kuliah</th>
                                <th>sks</th>
                                <th>Kelas yang Di ajar</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detail_dosen as $item)
                            <tr>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama_dosen }}</td>
                                <td>{{ $item->program_studi }}</td>
                                <td>{{ $item->nama_mk }}</td>
                                <td>{{ $finalSksMk[$item->matkul_id] }}</td>
                                <td>{{ $finalKelasMk[$item->matkul_id] }}</td>

                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div>
            <div>
                <h6>Tabel Alih Pengajaran Dosen</h6>
            </div>
            <div>
                <div>
                    <table width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Program Studi</th>
                                <th>Mata Kuliah</th>
                                <th>sks</th>
                                <th>Kelas yang Di ajar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alih_ajar as $data)
                            <tr>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->nama_dosen }}</td>
                                <td>{{ $data->program_studi }}</td>
                                <td>{{ $data->nama_mk }}</td>
                                <td>{{ $data->sks }}</td>
                                <td>{{ $data->jum_kelas }}</td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>