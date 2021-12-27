<div>
    <div class="row">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        
         <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
     
      
        <div class="col-xl col-lg">
            <form wire:submit.prevent="storePpengajaran" action="">
                
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="pb-2">
                        
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun Ajaran</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <select class="form-control" wire:model="tahun_ajaran" id="sel1">
                                <option value="" ></option>
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
                                <input class="mr-1" type="radio" wire:change="change" name="sms" wire:model="sms" id="" value="2"><label class="mr-3" for="">Genap</label>
                                <input class="mr-1" type="radio" wire:change="change" name="sms" wire:model="sms" id="" value="1"><label for="">Ganjil</label>
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
                            <input type="text" class="form-control" wire:model="sks" name="sks" readonly required>
                           
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Rasio</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <select class="form-control" wire:model="rasio" id="sel1">
                                <option value="" ></option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">JUM. KELAS</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelas" name="jumkelas" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">JUM. KELAS PENYESUAIAN</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelasp" name="jumkelasp" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Mata Kuliah</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <div>
                                <input class="mr-1" type="radio" name="j_matkul" wire:model="matkul_jenis" id="" value="2"><label class="mr-3" for="">Kelompok</label>
                                <input class="mr-1" type="radio" name="j_matkul" wire:model="matkul_jenis" id="" value="3"><label for="">Individu</label>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Dosen PJ</label>
    
                                <x-lwa::autocomplete class="form-control"
                                name="user-name"
                                wire:model-text="namaDosen"
                                wire:model-id="idDosen"
                                wire:model-results="listDosen"
                                :options="[
                                'text'=> 'nama',
                                'id' => 'no_registrasi',
                                'allow-new'=> 'false',
                            ]"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No induk</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                               <div>
                                    <label for="">{{ $this->no_induk }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jabatan Fungsional</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                               <div>
                                    <label for="">{{ $this->bio_dosen }}</label>
                                </div>
                            </div>
                        </div>
                      

                        @if($matkul_jenis == 2)
                            
                        
                        <script>
                           $(document).ready(function() {
                               $('.js-example-basic-multiple').select2();
                           });
                       </script>
                            <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple">
                                <option value="AL">Alabama</option>
                                   
                                <option value="WY">Wyoming</option>
                            </select>
                           
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Data</button> <button type="submit" wire:submit.prevent="clearForm" class="btn btn-primary">Clear</button>
                        </div>
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
        
    
    </div>
</div>


