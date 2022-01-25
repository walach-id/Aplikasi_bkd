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

                            <th>Dosen Penerima</th>
                            <th>SKS Di Dapat</th>

                            <th>Jumlah Mengajar Diberikan</th>

                            <th>Mengajar Pertemuan Ke-</th>
                            <th>action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pengalihan as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->sks_didapat }}</td>
                                <td>{{ $data->jum_mengajar_diberikan }}</td>
                                <td>{{ $data->mengajar_pertemuan_ke }}</td>

                                <td><a href="/form/persetujuan/{{ $data->id_pengajaran_asal }}/{{ $data->id_pemberian }}"
                                        class="mb-4 btn btn-primary">Setujui</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
