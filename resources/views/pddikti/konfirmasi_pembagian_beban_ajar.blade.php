<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengajuan Pengajaran Dosen</h1>
    </div>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header flex justify-between">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajuan Pembagian Beban Ajar Dosen</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengajaran</th>
                            <th>ID Pengalihan</th>
                            <th>Nama Dosen</th>

                            <th>Status</th>


                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pembagian_dosen as $data)
                            <tr>
                                <td><a
                                        href="/honor/data/detail/{{ $data->id_pengajaran_asal }}">{{ $data->id_pengajaran_asal }}</a>
                                </td>
                                <td>{{ $data->id_pengalihan }}</td>
                                <td>{{ $data->nama_dosen }}</td>
                                <td>{{ $data->status }}</td>
                                <td><a href="/konfirmasi/beban/ajar/{{ $data->id_pengalihan }}/{{ $data->id_pengajaran_asal }}/{{ $data->kode_dosen }}"
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
