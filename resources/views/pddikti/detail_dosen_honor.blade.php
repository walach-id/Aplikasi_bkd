<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data Pengajaran Dosen Honor</h1>

        <a href="{{ url('/pddikti/pengajaran/cetak/') }}" class="btn btn-primary">Cetak Laporan</a>

    </div>

    <div class="card">
        <div class="card-header">
            Detail Data Pengajaran Honor
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <th>ID Pengajaran</th>
                    <td>: </td>
                    <td>{{ $detail_dosen->id_pengajaran_honor }}</td>
                </tr>
                <tr>
                    <th>Nama Dosen</th>
                    <td>: </td>
                    <td>{{ $detail_dosen->nama_dosen }}</td>
                </tr>
                <tr>
                    <th>Mata Kuliah</th>
                    <td>: </td>
                    <td>{{ $detail_dosen->nama_matkul }}</td>
                </tr>
                <tr>
                    <th>SKS</th>
                    <td>: </td>
                    <td>{{ $detail_dosen->sks_asli }}</td>
                </tr>
                <tr>
                    <th>Tahun Akademik</th>
                    <td>: </td>
                    <td>{{ $detail_dosen->akademik_tahun }}</td>
                </tr>
                <tr>
                    <th valign="top">Anggota Pengajaran</th>
                    <td valign="top">: </td>
                    <td valign="top">
                        @foreach ($anggota as $item)
                            @if ($item->nama_dosen == null)
                                -
                            @else
                                {{ $item->nama_dosen }} <br />
                            @endif
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>


</x-app-layout>
