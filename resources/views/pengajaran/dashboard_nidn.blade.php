@include('partials.app')

<div id="wrapper">

    <!-- Sidebar -->
    @include('partials.side_bar')
    <!-- End Of Side Bar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('partials.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <a href="{{ url('/bkd/form') }}" class="btn btn-primary mb-4">Tambah Data Baru</a>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
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
                                        <td><a href="{{ url('/bkd/detail/'.$item->id) }}" class="btn btn-primary mb-4">Detail</a></td>
                                    </tr>
                                    @empty

                                    @endforelse



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
</div>
@include('partials.footer')