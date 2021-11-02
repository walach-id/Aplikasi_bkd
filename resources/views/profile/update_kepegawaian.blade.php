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
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kepegawaian</h6>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="pb-2">
                                    <form action="{{ url('update/kepegawaian') }}" method="POST">
                                        @csrf
                                        @foreach ($profil as $item)
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Program Studi</label>
                                                <select class="form-control" name="prodi" id="sel1" required>
                                                    @foreach ($prodi as $data)
                                                        <option value="{{ $data->program_studi }}"
                                                            {{ $item->program_studi == $data->program_studi ? 'selected' : '' }}>
                                                            {{ $data->program_studi }}</option>
                                                    @endforeach
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
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No.HP Aktif</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nohp"
                                        value="{{ $item->nohp }}" required minlength="11">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email Aktif</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                        value="{{ $item->email }}" required>
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
