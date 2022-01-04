<div>
    <div class="row">
        <div class="col-xl col-lg">
            <form wire:submit.prevent="storePpengajaran" action="">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pb-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Ajaran</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                                <select class="form-control" wire:model="tahun_ajaran" wire:change="change" id="sel1">
                                    <option value=""></option>
                                    @foreach ($tahun as $data)
                                        <option value="{{ $data->thn_akademik }}">{{ $data->thn_akademik }}</option>
                                    @endforeach
                                </select>
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
                                <option value=""></option>
                                <option value="30">30</option>

                                <option value="40">40</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">JUM. KELAS</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelas" name="jumkelas" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">JUM. KELAS PENYESUAIAN</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelasp" name="jumkelasp" value="0">
                        </div>

                        <hr style="color: black; border-top: 1px solid red;">
                        <div class="form-group">
                            <label for="">Pilih Dosen | Untuk Keperluan Honor (Internal STIKIM)</label><br>
                            <label style="color:red; font-weight:bold;" for="">Jika dipilih berkelompok, dosen ini akan menjadi PJ</label>
                            <x-lwa::autocomplete class="form-control" name="listDosenHonor" wire:model-text="namaDosenHonor" wire:model-id="idDosenHonor" wire:model-results="listDosenHonor" :options="[
                                'text'=> 'nama_dosen',
                                'id'=> 'kode_dosen',
                                'allow-new'=> 'false',
                            ]" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Pengajaran Mata Kuliah</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <div>
                                <!-- wire:model="matkul_jenis" -->
                                <input wire:model="matkul_jenis_honor" class="mr-1" type="radio" name="j_matkul_honor" id="" value="Kelompok"><label class="mr-3" for="">Kelompok</label>
                                <input wire:model="matkul_jenis_honor" class="mr-1" type="radio" name="j_matkul_honor" id="" value="Individu"><label for="">Individu</label>
                            </div>
                        </div>
                        @if($matkul_jenis_honor === "Kelompok")
                        <div class="form-group">
                            <label for="">Dosen Anggota</label><br>
                            <x-lwa::autocomplete class="form-control" name="listDosenHonorAnggota" wire:model-text="namaDosenHonorAnggota" wire:model-id="idDosenHonorAnggota" wire:model-results="listDosenHonorAnggota" :options="[
                                'text'=> 'nama_dosen',
                                'id'=> 'kode_dosen',
                                'allow-new'=> 'false',
                            ]" />
                        </div>
                        <div class="flex">
                            @foreach ($listDosenHonorAnggotaTerpilih as $idDosenHonorAnggota => $namaDosenHonorAnggota)
                            <p>{{ $namaDosenHonorAnggota }}</p>
                            <button wire:click="removeFromMultiHonor({{$idDosenHonorAnggota}})" class="btn btn-danger">Hapus</button>
                            @endforeach
                        </div>

                        @else

                        @endif

                        <div class="form-group mt-8">
                            <label for="exampleInputEmail1">Untuk Keperluan PDDIKTI ? Apakah data dosen di samakan dengan atas</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <div>
                                <!-- wire:model="matkul_jenis" -->
                                <input wire:model="tipe_dosen_pengajaran" class="mr-1" type="radio" id="" value="1"><label class="mr-3" for="">Samakan</label>
                                <input wire:model="tipe_dosen_pengajaran" class="mr-1" type="radio" id="" value="2"><label for="">Bedakan</label>
                            </div>
                        </div>
                        @if($tipe_dosen_pengajaran == 1)
                        @elseif($tipe_dosen_pengajaran == 2)
                        <div class="form-group">
                            <label for="">Pilih Dosen | Untuk Keperluan Pelaporan PDDIKTI</label><br>
                            <label style="color:red; font-weight:bold;" for="">Jika dipilih berkelompok, dosen ini akan menjadi PJ</label>
                            <x-lwa::autocomplete class="form-control" name="listDosen" wire:model-text="namaDosen" wire:model-id="idDosen" wire:model-results="listDosen" :options="[
                                'text'=> 'nama',
                                'id'=> 'no_registrasi',
                                'allow-new'=> 'false',
                            ]" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Pengajaran Mata Kuliah</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <div>
                                <!-- wire:model="matkul_jenis" -->
                                <input wire:model="matkul_jenis" class="mr-1" type="radio" name="j_matkul" id="" value="Kelompok"><label class="mr-3" for="">Kelompok</label>
                                <input wire:model="matkul_jenis" class="mr-1" type="radio" name="j_matkul" id="" value="Individu"><label for="">Individu</label>
                            </div>
                        </div>
                        @if($matkul_jenis === "Kelompok")
                        <div class="form-group">
                            <label for="">Dosen Anggota</label><br>
                            <x-lwa::autocomplete class="form-control" name="listDosenAnggota" wire:model-text="namaDosenAnggota" wire:model-id="idDosenAnggota" wire:model-results="listDosenAnggota" :options="[
                                'text'=> 'nama',
                                'id'=> 'no_registrasi',
                                'allow-new'=> 'false',
                            ]" />
                        </div>
                        <div class="flex">
                            @foreach ($listDosenAnggotaTerpilih as $idDosenAnggota => $namaDosenAnggota)
                            <p>{{ $namaDosenAnggota }}</p>
                            <button wire:click="removeFromMulti({{$idDosenAnggota}})" class="btn btn-danger">Hapus</button>
                            @endforeach
                        </div>


                        @else
                        @endif
                        @endif


                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary mt-12 mb-4">Save Data</button>
                            <button type="submit" wire:submit.prevent="clearForm" class="form-control btn btn-primary">Clear</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>