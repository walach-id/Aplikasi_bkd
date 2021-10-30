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
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Foto Profil</h6>
                                <div class="dropdown no-arrow">


                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <img width="180" src="{{asset('assets/images/img1.svg')}}" class="img-fluid img-thumbnail rounded" alt="Foto Profil">
                                </div>
                                <div class="mt-4 text-center small">
                                    <form action="{{ url('/save/profil') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input required type="file" name="foto" id="">


                                </div>
                                <small style="font-weight: bold;">Maximal ukuran foto 10MB</small>
                                <br>
                                <small style="font-weight: bold;">Foto harus berformat png, jpeg, atay</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">

                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Profil</h6>

                            </div>

                            <div class="card-body">
                                <div class="pb-2">

                                    <div class="form-group">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pilih salah satu</label>

                                            <select class="form-control" name="jenispengenal" id="sel1" required>
                                                <option value="NIDN">NIDN</option>
                                                <option value="NIDK">NIDK</option>
                                                <option value="NUP">NUP</option>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="idpengenal" placeholder="Ketik ID (Sesuai Pilihan di atas) Disini" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NAMA</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nama" placeholder="Nama Lengkap Tanpa Gelar" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">JENIS KELAMIN</label>
                                        <select class="form-control" name="jenkel" id="sel1" required>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">TEMPAT LAHIR</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">TANGGAL LAHIR</label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="tanggallahir" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">

                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kependudukan</h6>

                            </div>

                            <div class="card-body">
                                <div class="pb-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NIK</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nik" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NPWP</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="npwp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">KEWARGANEGARAAN</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="warganegara" placeholder="Ketik Asal Negara Anda" required>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">

                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kepegawaian</h6>

                            </div>

                            <div class="card-body">
                                <div class="pb-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Program Studi</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="prodi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">No.HP Aktif</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nohp" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email Aktif</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Profil</button>
                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        @include('partials.footer')