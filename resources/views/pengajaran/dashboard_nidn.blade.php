<x-app-layout>
    <!-- Page Heading -->
    <a href="{{ url('/bkd/form') }}" class="mb-4 btn btn-primary">Tambah Data Baru</a>
    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajaran Dosen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mata Kuliah</th>
                            <th>Program Studi</th>
                            <th>SKS</th>
                            <th>Jumlah Pertemuan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Mata Kuliah</th>
                            <th>Program Studi</th>
                            <th>SKS</th>
                            <th>Jumlah Pertemuan</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($pengajaran as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->matkul_id }}</td>

                                <td>{{ $item->prodi_id }}</td>

                                <td>{{ $item->sks }}</td>

                                <td>{{ $item->jumlah_pertemuan }}</td>
                                <td><a href="{{ url('/bkd/detail/' . $item->id) }}"
                                        class="mb-4 btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>