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
                    <h1 class="h3 mb-0 text-gray-800">Lengkapi Data Pribadi</h1>

                </div>

                <div class="row">

                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">

                            <div class="card-body">
                                <div class="pb-2">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">JENIS KEGIATAN / MATA KULIAH</label>
                                        <select class="form-control" name="matkul" id="sel1" required>
                                            @forelse($matkul as $item)
                                            <option value="Laki-Laki">{{ $item->nama_mk }}</option>
                                            @empty
                                            <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">BUKTI PENUGASAN</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">JUM.SKS</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">MASA PENUGASAN (BULAN)</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="tanggallahir" required>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">

                            <div class="card-body">
                                <div class="pb-2">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">BUKTI DOKUMEN</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">JUM.PERTEMUAN</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NAMA DOSEN 1</label>
                                        <br>
                                        <input type="text" list="dosen" style="width:330px;" />
                                        <datalist id="dosen">
                                            @forelse($dosen as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @empty
                                            <option disabled> DATA DOSEN TIDAK DI TEMUKAN</option>
                                            @endforelse
                                        </datalist>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">JUMLAH PENYERAHAN TUGAS</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required">
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>







                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        @include('partials.footer')