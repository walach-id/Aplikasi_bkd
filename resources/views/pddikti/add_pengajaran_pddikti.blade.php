<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lengkapi Data Berikut</h1>
    </div>
    
        @csrf
        <div class="row">
            
            <div class="col-xl-4 col-lg-5">
                <form action="{{ url('/pddikti/form/add') }}" method="post">
                    @csrf
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pb-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NAMA DOSEN</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" value="" required> --}}
                                <select class="form-control" name="dosen" id="sel1" required>
                                    @forelse($dosen as $item)
                                    <option value="{{ $item->nik }}">{{ $item->name }}</option>
                                    @empty
                                    <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">PRODI</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="prodi" required> --}}
                                <select class="form-control" name="prodi" id="sel1" required>
                                    @forelse($prodi as $item)
                                    <option value="{{ $item->id_prodi }}">{{ $item->program_studi }}</option>
                                    @empty
                                    <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">MATA KULIAH</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                                <select class="form-control" name="matkul" id="sel1" required>
                                    @forelse($matkul as $item)
                                    <option value="{{ $item->kode_mk }}">{{ $item->nama_mk }}</option>
                                    @empty
                                    <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">SKS</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="sks" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">SEMESTER</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="semester" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">JUM. KELAS</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="jumkelas" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Data</button>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">JENIS KEGIATAN / MATA KULIAH</label>
                                <select class="form-control" name="matkul" id="sel1" required>
                                    @forelse($matkul as $item)
                                    <option value="{{ $item->nama_mk }}">{{ $item->nama_mk }}</option>
                                    @empty
                                    <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                    @endforelse
                                </select>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">BUKTI PENUGASAN</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="buktipenugasan" required>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">JUM.SKS</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="jumsks" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">MASA PENUGASAN (BULAN)</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="masapenugasan" required>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </form>
            </div>
        
        
            <div class="col-xl-4 col-lg-5">
                <form action="{{ url('/pddikti/form/import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pb-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Import data excel pengajaran</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" name="file" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Import Excel</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        
        </div>
    
</x-app-layout>