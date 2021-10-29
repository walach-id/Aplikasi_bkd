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
                @forelse($profil as $item)
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Pribadi</h1>


                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <span class="mb-0 pb-2 text-gray-800">Terakhir diperbaruhi : {{date('j F Y', strtotime($item->updated_at)) }}</span>
                <br>
                <a href="{{ url('delete/profil/'. $item->id.'/'.$item->nama.'/'.$item->foto) }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-eraser fa-sm text-white-50"></i> HAPUS PROFIL</a>

                <div class="row pt-4">

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
                                <div class="pt-4 pb-2 d-flex justify-content-center">
                                    <img width="180" src="{{asset ('assets/images/foto/profil/' . $item->nama.'/'.$item->foto) }}" class="img-fluid img-thumbnail rounded" alt="Foto Profil">
                                </div>
                                <div class="mt-4 text-center small">
                                    <form action="{{ url('/change/photo/profile/'.$item->user_profile) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="fotoganti" id="">
                                        <button type="submit" class="btn btn-primary">Ubah Foto</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Profil</h6>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="pb-2">
                                    <form>
                                        <div class="form-group">

                                            @if($item->nidn)
                                            <label for="exampleInputEmail1">NIDN</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nidn" readonly value="{{ $item->nidn }}">
                                            @elseif($item->nidk)
                                            <label for="exampleInputEmail1">NIDK</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nidk" value="{{ $item->nidk }}" readonly>
                                            @elseif($item->nup)
                                            <label for="exampleInputEmail1">NUP</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nup" readonly value="{{ $item->nup }}">
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">NAMA</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{$item->nama}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">JENIS KELAMIN</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{$item->jenkel}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">TEMPAT LAHIR</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{$item->tempat_lahir}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">TANGGAL LAHIR</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{date('j F Y', strtotime($item->tanggal_lahir)) }}">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                                </div>

                            </div>
                            </li>




                        </div>
                    </div>


                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kependudukan</h6>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="pb-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NIK</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{$item->nik}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NPWP</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{$item->npwp}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">KEWARGANEGARAAN</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{$item->kewarganegaraan}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kepegawaian</h6>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="pb-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Program Studi</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{$item->program_studi}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">No.HP Aktif</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{$item->nohp}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email Aktif</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{$item->email}}">
                                    </div>
                                    <a href="{{ url('/change/kepegawaian/profil/'.$item->user_profile) }}" class="btn btn-primary">Ubah Data Kepegawaian</a>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Account Login</h6>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="pb-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{$item->program_studi}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{$item->nohp}}">
                                    </div>

                                    <a href="{{ url('/change/kepegawaian/profil/'.$item->user_profile) }}" class="btn btn-primary">Ubah Username/Password</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- /.container-fluid -->

        @empty
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{ url('add/profil/') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> HARAP LENGKAPI PROFIL ANDA</a>
            </div>
        </div>
        @endforelse

        @include('partials.footer')