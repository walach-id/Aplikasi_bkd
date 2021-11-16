<div>
    <div class="row">
            
        <div class="col-xl-4 col-lg-5">
            <form>
                @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="pb-2">
                        
         
                        <div class="form-group">
                            <label for="exampleInputEmail1">PRODI</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="prodi" required> --}}
                            <select class="form-control" wire:model="prodi" name="prodi" id="sel1" required>
                                <option value="" ></option>
                                @forelse($data_prodi as $item)
                                <option value="{{ $item->id_prodi }}">{{ $item->program_studi }}</option>
                                @empty
                                <option disabled selected> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                @endforelse
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun Ajaran</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <select class="form-control" wire:model="tahun_ajaran" id="sel1">
                                <option value=""></option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                            
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Semester Tahun Ajaran</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                           <div>
                                <input class="mr-1" type="radio" wire:model="sms" id="" value="2"><label for="">Genap</label>
                                <input class="mr-1" type="radio" wire:model="sms" id="" value="1"><label for="">Ganjil</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">MATA KULIAH</label><br>
                            <small> Keterangan : [KODE MATKUL] - NAMA MATKUL - SKS</small>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <select class="form-control" wire:model="matkul" name="matkul" id="sel1">
                                <option value=""></option>
                                @forelse($data_matkul as $item)
                                <option value="{{ $item->kode_mk }}">({{ $item->kode_mk }}), {{ $item->nama_mk }} - {{ $item->jml_sks }}</option>
                                @empty
                                <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Banyak Mahasiswa</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                           <div>
                                <label for="">{{ $mahasiswa }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">SKS</label>
                            <input type="text" class="form-control" wire:model="sks" name="sks" required>
                           
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">RASIO</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" wire:model="rasio" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">JUM. KELAS</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelas" name="jumkelas" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NAMA DOSEN</label>
                            
                            <select class="theSelect form-control" wire:model="dosen" id="sel1" required>
                                <option value=""></option>
                                @foreach ($data_dosen as $data)
                                    <option value="{{$data->no_registrasi}}">{{$data->nama}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <button wire:submit.prevent="storePpengajaran" type="submit" class="btn btn-primary">Save Data</button> <button type="submit" wire:submit.prevent="clearForm" class="btn btn-primary">Clear</button>
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
    <script>
		$(".theSelect").select2();
	</script>
</div>
