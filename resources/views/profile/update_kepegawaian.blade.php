<x-app-layout>
    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Ubah data di bawah ini</h1>
        <!-- <a href="#" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                                  -->
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="mb-4 shadow card">
                <!-- Card Header - Dropdown -->
                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Kepegawaian</h6>
                </div>
                
                            <!-- Card Body -->
                            <div class="card-body">
                                    <form action="{{ url('update/kepegawaian') }}" method="POST">
                                        @csrf
                                        @foreach ($profil as $item)
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Program Studi</label>
                                                <select class="form-control" name="prodi" id="sel1" required>
                                                    @foreach ($prodi as $data)
                                                        <option value="{{ $data->id_prodi }}"
                                                            {{ $item->program_studi_id == $data->id_prodi ? 'selected' : '' }}>
                                                            {{ $data->program_studi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jabatan</label>
                                                <select class="form-control" name="jabatan" id="sel1" required>
                                                    <option value="Asisten Ahli" {{ $item->jabatan == "Asisten Ahli" ? 'selected' : '' }}>Asisten Ahli</option>
                                                    <option value="Lektor" {{ $item->jabatan == "Lektor" ? 'selected' : '' }}>Lektor</option>
                                                    <option value="Lektor Kepala" {{ $item->jabatan == "Lektor Kepala" ? 'selected' : '' }}>Lektor Kepala</option>
                                                    <option value="Guru Besar" {{ $item->jabatan == "Guru Besar" ? 'selected' : '' }}>Guru Besar</option>
                                                    <option value="Profesor" {{ $item->jabatan == "Profesor" ? 'selected' : '' }}>Profesor</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Type Dosen</label>
                                                <select class="form-control" name="dosen_type" id="sel1" required>
                                                    <option value="Dosen Tetap" {{ $item->dosen_type == "Dosen Tetap" ? 'selected' : '' }}>Dosen Tetap</option>
                                                    <option value="Dosen Tidak Tetap" {{ $item->dosen_type == "Dosen Tidak Tetap" ? 'selected' : '' }}>Dosen Tidak Tetap</option>
                                                    <option value="Dosen Honorer" {{ $item->dosen_type == "Dosen Honorer" ? 'selected' : '' }}>Dosen Honorer</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No.HP Aktif</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="nohp" value="{{ $item->nohp }}" required minlength="11">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email Aktif</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    name="email" value="{{ $item->email }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Data</button>
                                
                                @endforeach
                                </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
