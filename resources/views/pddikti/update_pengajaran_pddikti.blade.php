<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lengkapi Data Berikut</h1>
    </div>
    
    <div class="row">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <div class="col-xl-4 col-lg-5">
            <form method="POST" action="/pddikti/dosen/detail/{{ $get_dosen->nik }}/alihkan/add">
                @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="pb-2">
                        
         
                        <div class="form-group">
                            <label for="exampleInputEmail1">PRODI</label>
                            <input type="text" value="{{ $get_dosen->prodi_id }}" class="form-control" id="exampleInputEmail1" name="prodi" required>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun Akademik</label>
                            <input type="text" value="{{ $get_dosen->akademik_tahun }}" class="form-control" id="exampleInputEmail1" name="tahun_ajaran" required>
                           
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">MATA KULIAH</label><br>
                            <small> Keterangan : [KODE MATKUL] - NAMA MATKUL - SKS</small>
                            <input type="text" value="{{ $get_dosen->matkul_id }}" class="form-control" id="exampleInputEmail1" name="matkul" required>
                            
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">SKS</label>
                            <input type="text" value="{{ $get_dosen->sks }}" class="form-control" wire:model="sks" name="sks" readonly required>
                           
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">JUM. KELAS</label>
                            <input type="text" value="{{ $get_dosen->jum_kelas }}" class="form-control" id="exampleInputEmail1" wire:model="jumkelas" name="jumkelas" readonly required>
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
                            <label for="exampleInputEmail1">SKS</label>
                            <input type="text" class="form-control" wire:model="sks" name="sks" required>
                           
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">JUM. KELAS</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelas" name="jumkelas" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NAMA DOSEN</label>
                            <input class="form-control" list="browsers" name="dosen" id="dosen">
                            <datalist id="browsers">
                                @foreach ($list_dosen as $data)
                                    <option value="{{ $data->no_registrasi }}">{{ $data->nama }}</option>
                                @endforeach
                            </datalist>    
                        </div>
                       <input type="submit" value="Alihkan Beban Ajar" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
        </div>
        
    
        
    
    </div>
        
    
</x-app-layout>