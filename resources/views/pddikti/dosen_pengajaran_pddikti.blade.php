<x-app-layout>
    <!-- Page Heading -->
    
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
                            <th>NIK</th>
                            <th>Nama Dosen</th>
                            <th>Program Studi</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Jumlah Kelas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Dosen</th>
                            <th>Program Studi</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Jumlah Kelas</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($pengajaran as $item)
                        <tr>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama_dosen }}</td>

                            <td>{{ $item->program_studi }}</td>

                            <td>{{ $item->nama_mk }}</td>

                            <td>{{ $item->sks }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->jum_kelas }}</td>
                            <td><a href="#" class="mb-4 btn btn-primary">Detail</a>
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