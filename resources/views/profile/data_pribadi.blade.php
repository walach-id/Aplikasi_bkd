<x-app-layout>
    @forelse($profil as $item)
    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Data Pribadi</h1>
    </div>
    <span class="pb-2 mb-0 text-gray-800">Terakhir diperbaruhi :
        {{ date('j F Y', strtotime($item->updated_at)) }}</span>
    <br>
    <a href="{{ url('delete/profil/' . $item->id . '/' . $item->nama . '/' . $item->foto) }}" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-danger"><i class="fas fa-eraser fa-sm text-white-50"></i>
        HAPUS PROFIL</a>

    <div class="pt-4 row">

        <div class="col-xl-4 col-lg-5">

            <div class="mb-4 shadow card">
                <!-- Card Header - Dropdown -->
                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Profil</h6>
                    <div class="dropdown no-arrow">


                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pt-4 pb-2 d-flex justify-content-center">
                        <img width="180" src="{{ asset('assets/images/foto/profil/' . $item->nama . '/' . $item->foto) }}" class="rounded img-fluid img-thumbnail" alt="Foto Profil">
                    </div>
                    <div class="mt-4 text-center small">
                        <form action="{{ url('/change/photo/profile/' . $item->user_profile) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="fotoganti" id="">
                            <button type="submit" class="btn btn-primary">Ubah Foto</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="mb-4 shadow card">
                <!-- Card Header - Dropdown -->
                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Profil</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pb-2">
                        <form>
                            <div class="form-group">

                                @if ($item->nidn)
                                <label for="exampleInputEmail1">NIDN</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="nidn" readonly value="{{ $item->nidn }}">
                                @elseif($item->nidk)
                                <label for="exampleInputEmail1">NIDK</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="nidk" value="{{ $item->nidk }}" readonly>
                                @elseif($item->nup)
                                <label for="exampleInputEmail1">NUP</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="nup" readonly value="{{ $item->nup }}">
                                @elseif($item->nip)
                                <label for="exampleInputEmail1">NIP</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="nup" readonly value="{{ $item->nip }}">

                                @endif

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">NAMA</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{ $item->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">JENIS KELAMIN</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{ $item->jenkel }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">TEMPAT LAHIR</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{ $item->tempat_lahir }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">TANGGAL LAHIR</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{ date('j F Y', strtotime($item->tanggal_lahir)) }}">
                            </div>
                            <a href="{{ url('/change/profil/' . $item->user_profile) }}" class="btn btn-primary">Ubah
                                Data Profil</a>
                    </div>
                </div>
                </li>
            </div>
        </div>


        <div class="col-xl-4 col-lg-5">
            <div class="mb-4 shadow card">
                <!-- Card Header - Dropdown -->
                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Kependudukan</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pb-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIK</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{ $item->nik }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NPWP</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{ $item->npwp }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">KEWARGANEGARAAN</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{ $item->kewarganegaraan }}">
                        </div>
                        <a href="{{ url('/change/kependudukan/profil/' . $item->user_profile) }}" class="btn btn-primary">Ubah Data Kependudukan</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="mb-4 shadow card">
                <!-- Card Header - Dropdown -->
                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Kepegawaian</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pb-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Program Studi</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama" readonly value="{{ $item->program_studi }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No.HP Aktif</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{ $item->nohp }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Aktif</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="jenkel" readonly value="{{ $item->email }}">
                        </div>
                        <a href="{{ url('/change/kepegawaian/profil/' . $item->user_profile) }}" class="btn btn-primary">Ubah Data Kepegawaian</a>
                    </div>

                </div>
            </div>
        </div>




    </div>
    <!-- /.container-fluid -->
    <!-- /.container-fluid -->
    @empty
    <div class="container-fluid">
        <div class="mb-4 d-sm-flex align-items-center justify-content-between">
            <a href="{{ url('add/profil/') }}" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> HARAP LENGKAPI PROFIL ANDA</a>
        </div>
    </div>
    @endforelse
</x-app-layout>