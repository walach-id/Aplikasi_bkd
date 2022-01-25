<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengajuan Pengajaran Dosen</h1>
    </div>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header flex justify-between">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajuan Pengajaran Dosen</h6>
            <a href="{{ url('/pddikti/pengajaran/cetak') }}" class="btn btn-primary">Cetak Laporan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengajaran</th>
                            <th>ID Pengalihan</th>
                            <th>Dosen PJ</th>

                            <th>Mata Kuliah</th>
                            <th>Tahun Akademik</th>
                            <th>SKS Matkul</th>
                            <th>Tipe Mengajar</th>

                            <th>action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($alih_ajar_pddikti as $data)
                            <tr>
                                <td>{{ $data->id_pengajaran_asal }}</td>
                                <td>{{ $data->id_pemberian }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->nama_matkul }}</td>
                                <td>{{ $data->akademik_tahun }}</td>
                                <td>{{ $data->sks_asli }}</td>
                                <td>{{ $data->tipe_mengajar }}</td>

                                <td><a href="/detail/konfirmasi/pengajaran/{{ $data->id_pengajaran_asal }}/{{ $data->id_pemberian }}"
                                        class="mb-4 btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
