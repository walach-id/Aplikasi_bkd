<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pengajaran Dosen</h1>
    </div>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header flex justify-between">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajaran Dosen</h6>
            <a href="{{ url('/pddikti/pengajaran/cetak') }}" class="btn btn-primary">Cetak Laporan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengajaran</th>
                            <th>Nama Dosen</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Tahun Akademik</th>
                            <th>SKS</th>
                            <th>action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data_dosen as $item)
                            <tr>
                                <td>{{ $item->id_pengajaran_honor }}</td>
                                <td>{{ $item->nama_dosen }}</td>
                                <td>{{ $item->nama_matkul }}</td>
                                <td>{{ $item->akademik_tahun }}</td>
                                <td>{{ $item->sks_asli }}</td>
                                {{-- @if ($item->jum >= 16)
                                <td>{{ $item->jum }} <span class="bg-red-500 py-1 px-2 ml-1 text-white rounded-full">Lebih batas minimum</span></td>
                                
                                @else
                                <td>{{ $item->jum }}</td>
                                @endif --}}
                                <td><a href="{{ url('/honor/data/detail/' . $item->id_pengajaran_honor) }}"
                                        class="mb-4 btn btn-primary">Detail</a></td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
