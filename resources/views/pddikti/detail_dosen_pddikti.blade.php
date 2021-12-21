<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data Pengajaran Dosen</h1>
        
            <a href="{{ url('/pddikti/pengajaran/cetak/'.$cnik->nik.'') }}" class="btn btn-primary">Cetak Laporan</a>
        
    </div>
    
    <div>
    
        <!-- DataTales Example -->
        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajaran Dosen</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-success text-white">
                                <th>ID Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Program Studi</th>
                                <th>Mata Kuliah</th>
                                <th>sks</th>
                                <th>Kelas yang Di ajar</th>
                                <th>action</th>
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
                                {{-- <td>{{ $item->sks }}</td> --}}
                                <td>{{ $finalKelasMk[$item->matkul_id] }}</td>
                                <td><a href="{{ url('/pddikti/dosen/detail/'.$item->id.'/alihkan') }}" class="mb-4 btn btn-primary">alihkan beban SKS</a></td>
                            </tr>
                            @empty
    
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Alih Pengajaran Dosen</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-danger text-white">
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

    
</x-app-layout>