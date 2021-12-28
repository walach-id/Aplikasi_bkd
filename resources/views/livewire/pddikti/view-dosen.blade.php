<div>
    
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
                                <th>ID Dosen</th>
                                <th>Nama Dosen</th>
                                <th>SKS</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse($data_dosen as $item)
                            <tr>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama_dosen }}</td>
                                @if($item->sum >= 16)
                                <td>{{ $item->sum }} <span class="bg-red-500 py-1 px-2 ml-1 text-white rounded-full">Lebih batas minimum</span></td>
                                
                                @else
                                <td>{{ $item->sum }}</td>
                                @endif
                                <td><a href="{{ url('/pddikti/dosen/detail/'.$item->nik) }}" class="mb-4 btn btn-primary">Detail</a></td>
                            </tr>
                            @empty
    
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
    
</div>
