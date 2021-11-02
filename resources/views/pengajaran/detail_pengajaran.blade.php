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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Detail Pengajaran</h1>

                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Detail Pengajaran</h6>

                        </div>

                        <div class="card-body">
                            <div class="pb-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NAMA</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" placeholder="Nama Lengkap Tanpa Gelar" required value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NAMA MATA KULIAH</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->kode_mk }}, {{$pengajaran->nama_mk}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">PROGRAM STUDI</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->id_prodi }},  {{ $pengajaran->program_studi }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">JUMLAH SKS</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->sks }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">MASA PENUGASAN</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->masa_penugasan}} bulan">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">BUKTI PENUGASAN</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->bukti_penugasan }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">BUKTI DOKUMEN</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->bukti_dokumen }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">JUMLAH PERTEMUAN</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->jumlah_pertemuan }}">
                                </div>

                                <div class="form-group">
                                    @if ($pengajaran->user_id == Auth::user()->id)
                                        <label for="exampleInputEmail1">MEMBERIKAN KE-</label>
                                    @else
                                        <label for="exampleInputEmail1">DIBERIKAN OLEH</label>
                                    @endif
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->name }}">
                                </div>
                                

                                <div class="form-group">
                                    <label for="exampleInputEmail1">JUMLAH WEWENANG YANG DIBERIKAN</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required value="{{ $pengajaran->jumlah_wewenang }} SKS">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        @include('partials.footer')